<?php

namespace app\controllers;

use DateTime;
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
        $request = Yii::$app->getRequest();
        $headers = $request->getHeaders();

        $userAgent = $headers['user-agent'];

        $time = new DateTime();
        $date = $time->format('Y-m-d H:i:s');
        $userId = $request->getBodyParam('user');
        
        $db = Yii::$app->db;
        $db->createCommand()->insert('connections', [
            'centrifugo_user_id' => $request->getBodyParam('client'),
            'user_agent' => $userAgent,
            'timestamp' => $date,
            'user_id' => $userId,
        ])->execute();

        return [
            "user" => $userId
        ];


    }

}
