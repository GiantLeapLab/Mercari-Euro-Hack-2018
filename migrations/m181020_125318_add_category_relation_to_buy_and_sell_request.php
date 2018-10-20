<?php

use yii\db\Migration;

/**
 * Class m181020_125318_add_category_relation_to_buy_and_sell_request
 */
class m181020_125318_add_category_relation_to_buy_and_sell_request extends Migration
{
    public function safeUp()
    {
        $this->addColumn('buy_request', 'category_id', $this->integer()->notNull());
        $this->addColumn('sell_request', 'category_id', $this->integer()->notNull());

        $this->addForeignKey('category_buy_request', 'buy_request', 'category_id', 'category', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('category_sell_request', 'sell_request', 'category_id', 'category', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey('category_buy_request', 'buy_request');
        $this->dropForeignKey('category_sell_request', 'sell_request');

        $this->dropColumn('buy_request', 'category_id');
        $this->dropColumn('sell_request', 'category_id');
    }
}
