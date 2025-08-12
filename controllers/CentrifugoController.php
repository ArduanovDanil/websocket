<?php

namespace app\controllers;

use Yii;
use yii\rest\Controller;

class CentrifugoController extends Controller
{

    protected function verbs()
    {
        return [
             'connect' => ['POST'],
        ];
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionConnect()
    {
        $params = Yii::$app->getRequest()->getBodyParams();
        Yii::error(print_r($params, true));
        //var_dump($params);
        return [
            "test" => 123
        ];
    }

    public function actionGenerateJwt()
    {
        $secretKey = 'AbL956IRfHaqWjqeUAsPj5DeeavBdz05FAk8pJyAMcKskXkWyJmiCybmGuTmy4krFJGElj5JAED5l3ejZ31jbA';
        $apiKey = 'VB1zjjkDpjbKPCWd0lcGzq5c2t_zTgbGdd-0kZan06AG3T8OV4JOAPF_OvPzuj7YwuYccXbo8qM9XR4ABnB8zQ';
        $userId = 1;

        //var_dump(333);
        //die;
        $client = new \phpcent\Client("http://localhost:9000/api");
        $client->setApiKey($apiKey);
        $client->publish("channel", ["message" => "Hello World"]);

        $token = $client->setSecret($secretKey)->generateConnectionToken($userId);


        return [
            'test' => 333,
            'token' => $token,
        ];
    }

}
