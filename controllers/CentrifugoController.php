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

}
