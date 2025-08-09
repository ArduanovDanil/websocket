<?php

namespace app\websocket;

use Amp\Http\Server\Request;
use Amp\Http\Server\Response;
use Amp\Websocket\Server\WebsocketClientHandler;
use Amp\Websocket\Server\WebsocketGateway;
use Amp\Websocket\Server\WebsocketClientGateway;
use Amp\Websocket\WebsocketClient;
use Monolog\Logger;
use function Amp\Redis\createRedisClient;

class Handler implements WebsocketClientHandler
{

    public function __construct(private readonly Logger $logger, private readonly WebsocketGateway $gateway = new WebsocketClientGateway())
    {
        //var_dump(1000);

    }


    public function handleClient(
                WebsocketClient $client,
                Request $request,
                Response $response,
            ): void {
                $this->logger->info('Message from handler');

                $authHeader = $request->getHeader('Token');

                $authHeader = $authHeader ?? 'test';

                $this->logger->info($authHeader);

                $this->gateway->addClient($client);

                $redis = createRedisClient('redis://');

                $redis->set('foo', '21');
                $result = $redis->increment('foo', 21);


                $this->logger->info($result);
                
                foreach ($client as $message) {

                    $this->gateway->sendText('text for send', $client->getId());

                    $this->gateway->broadcastText(sprintf(
                        '%d: %s',
                        $client->getId(),
                        (string) $message,
                    ));
                }
            }
}