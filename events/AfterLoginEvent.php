<?php
namespace app\events;

use Yii;

class AfterLoginEvent
{

    public static function generateJwtToken($event)

    {

        $user = Yii::$app->user;
        $secretKey = 'AbL956IRfHaqWjqeUAsPj5DeeavBdz05FAk8pJyAMcKskXkWyJmiCybmGuTmy4krFJGElj5JAED5l3ejZ31jbA';
        $apiKey = 'VB1zjjkDpjbKPCWd0lcGzq5c2t_zTgbGdd-0kZan06AG3T8OV4JOAPF_OvPzuj7YwuYccXbo8qM9XR4ABnB8zQ';
        $userId = $user->id;

        //var_dump(333);
        //die;
        $client = new \phpcent\Client("http://centrifugo:9000/api");
        $client->setApiKey($apiKey);
        //$client->publish("test_channel", ["message" => "Hello World"]);

        $token = $client->setSecret($secretKey)->generateConnectionToken($userId);

        dd($token);
      

    }
}