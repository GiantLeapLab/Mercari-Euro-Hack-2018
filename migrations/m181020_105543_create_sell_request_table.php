<?php

use yii\db\Migration;

/**
 * Handles the creation of table `sell_request`.
 */
class m181020_105543_create_sell_request_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('sell_request', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'price' => $this->double()->notNull(),
            'description' => $this->string(),
        ]);

        $this->addForeignKey('user_sell_request', 'sell_request', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('user_sell_request', 'sell_request');
        $this->dropTable('sell_request');
    }
}
