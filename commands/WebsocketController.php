<?php


namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;


class WebsocketController extends Controller
{
    /**
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionStart($message = 'hello world')
    {
        echo $message . "\n";

        return ExitCode::OK;
    }
}
