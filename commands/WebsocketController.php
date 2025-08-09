<?php


namespace app\commands;

use yii\console\Controller;

use Amp\Http\Server\DefaultErrorHandler;
use Amp\Http\Server\Router;
use Amp\Http\Server\SocketHttpServer;
use Amp\Http\Server\StaticContent\DocumentRoot;
use Amp\Log\ConsoleFormatter;
use Amp\Log\StreamHandler;
use Amp\Socket;
use Amp\Websocket\Server\AllowOriginAcceptor;
use Amp\Websocket\Server\Websocket;
use app\websocket\Handler;
use Monolog\Logger;
use function Amp\trapSignal;
use function Amp\ByteStream\getStdout;

class WebsocketController extends Controller
{
    /**
     * @return int Exit code
     */
    public function actionStart()
    {
        //var_dump(111);

        $logHandler = new StreamHandler(getStdout());
        $logHandler->setFormatter(new ConsoleFormatter());
        $logger = new Logger('server');
        $logger->pushHandler($logHandler);

        $server = SocketHttpServer::createForDirectAccess($logger);

        $server->expose(new Socket\InternetAddress('127.0.0.1', 1337));
        $server->expose(new Socket\InternetAddress('[::1]', 1337));

        $errorHandler = new DefaultErrorHandler();

        $acceptor = new AllowOriginAcceptor(
            ['http://localhost:1337', 'http://127.0.0.1:1337', 'http://[::1]:1337'],
        );

        $clientHandler = new Handler($logger);

        $websocket = new Websocket($server, $logger, $acceptor, $clientHandler);
    
        $router = new Router($server, $logger, $errorHandler);
        $router->addRoute('GET', '/broadcast', $websocket);
        $path = __DIR__ . '/../public';


        $router->setFallback(new DocumentRoot($server, $errorHandler, __DIR__ . '/public'));

        $server->start($router, $errorHandler);

        // Await SIGINT or SIGTERM to be received.
        $signal = trapSignal([SIGINT, SIGTERM]);

        $logger->info(sprintf("Received signal %d, stopping HTTP server", $signal));


        $server->stop();

    }
}
