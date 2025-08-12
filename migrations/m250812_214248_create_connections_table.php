<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%connections}}`.
 */
class m250812_214248_create_connections_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%connections}}', [
            'id' => $this->primaryKey(),
            'centrifugo_user_id' => $this->string(),
            'user_agent' => $this->string(),
            'user_id' =>$this->integer(),
            'timestamp' => $this->timestamp(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%connections}}');
    }
}
