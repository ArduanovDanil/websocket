<?php

use yii\base\BaseObject;
use yii\queue\JobInterface;
use \Yii;

class SaveWsDataJob extends BaseObject implements JobInterface
{
    public $data;

    public function execute($queue)
    {
        Yii::error('Message from Job');
    }
}