<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class CentrifugoController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionConnect()
    {
        Yii::error('Error message from CentrifugoController');
        var_dump(123);
     
        die;
        return $this->render('index');
    }

    public function actionCentrifugo()
    {
        return $this->render('centrifugo');
    }
}
