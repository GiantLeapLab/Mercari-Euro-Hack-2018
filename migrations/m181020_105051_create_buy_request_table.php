<?php

use yii\db\Migration;

/**
 * Handles the creation of table `buy_request`.
 */
class m181020_105051_create_buy_request_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('buy_request', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'min_price' => $this->double()->notNull(),
            'max_price' => $this->double()->notNull(),
            'description' => $this->string(),
        ]);

        $this->addForeignKey('user_buy_request', 'buy_request', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('user_buy_request', 'buy_request');
        $this->dropTable('buy_request');
    }
}
