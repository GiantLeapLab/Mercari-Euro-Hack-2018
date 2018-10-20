<?php

use yii\db\Migration;

/**
 * Class m181020_152513_add_imame_to_buy_request_table
 */
class m181020_152513_add_image_to_buy_request_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('image_to_buy_request', [
            'image_id' => $this->integer()->notNull(),
            'buy_request_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('image_buy_request', 'image_to_buy_request', 'buy_request_id', 'buy_request', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('image_images', 'image_to_buy_request', 'image_id', 'image', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('image_buy_request', 'image_to_buy_request');
        $this->dropForeignKey('image_images', 'image_to_buy_request');
        $this->dropTable('image_to_buy_request');
    }
}
