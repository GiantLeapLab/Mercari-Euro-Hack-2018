<?php

use yii\db\Migration;

/**
 * Class m181020_132045_update_requests_add_category_relations
 */
class m181020_132045_update_requests_add_category_relations extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('buy_request', 'category_id', $this->integer()->notNull());
        $this->addColumn('sell_request', 'category_id', $this->integer()->notNull());

        $this->addForeignKey('category_buy_request', 'buy_request', 'category_id', 'category', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('category_sell_request', 'sell_request', 'category_id', 'category', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('category_buy_request', 'buy_request');
        $this->dropForeignKey('category_sell_request', 'sell_request');

        $this->dropColumn('buy_request', 'category_id');
        $this->dropColumn('sell_request', 'category_id');
    }
}
