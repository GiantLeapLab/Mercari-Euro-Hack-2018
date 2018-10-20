<?php

use yii\db\Migration;

/**
 * Class m181020_153803_add_image_to_sell_request_table
 */
class m181020_153803_add_image_to_sell_request_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('image_to_sell_request', [
            'image_id' => $this->integer()->notNull(),
            'sell_request_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('image_sell_request', 'image_to_sell_request', 'sell_request_id', 'sell_request', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('image_sell_images', 'image_to_sell_request', 'image_id', 'image', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('image_sell_request', 'image_to_sell_request');
        $this->dropForeignKey('image_sell_images', 'image_to_sell_request');
        $this->dropTable('image_to_sell_request');
    }
}
