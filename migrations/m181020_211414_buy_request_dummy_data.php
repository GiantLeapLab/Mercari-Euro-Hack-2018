<?php

use yii\db\Migration;

/**
 * Class m181020_211414_buy_request_dummy_data
 */
class m181020_211414_buy_request_dummy_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('buy_request', ['user_id', 'title', 'min_price', 'max_price', 'description', 'category_id'],[
            [2, 'laptop', '24', '113', 'I would like to buy something cheap', 36],
            [2, 'awesome  laptop', '101', '1130', '', 36],
            [2, 'pink  laptop', '10', '374', '', 36],
            [2, 'laptop for child', '120', '187', '', 36],

            [2, 'phone', '42', '153', '', 40],
            [2, 'awesome  phone', '121', '130', '', 40],
            [2, 'yellow phone', '20', '74', '', 40],
            [2, 'phone for grandma', '1', '18', '', 40],

            [2, 'mug', '2', '13', '', 25],
            [2, 'tea cup', '11', '30', '', 25],
            [2, 'big cup', '4', '7', '', 25],
            [2, 'happy cup', '1', '8', '', 25],

            [2, 'apple mouse', '21', '43', '', 37],
            [2, 'game mouse', '12', '37', '', 37],
            [2, 'black mouse', '43', '77', '', 37],
            [2, 'working mouse', '11', '38', '', 37],

            [2, 'glass bottle', '1', '3', '', 23],
            [2, 'empty bottle', '2', '7', '', 23],
            [2, 'cooler bottle', '22', '75', '', 23],
            [2, 'clean bottle', '110', '380', '', 23],

            [2, 'children book', '12', '13', '', 46],
            [2, 'harry potter', '24', '78', '', 46],
            [2, 'As the Steel Was Tempered', '212', '775', '', 46],
            [2, 'dev book', '11', '38', '', 46],

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('buy_request', ['IN', 'user_id',[2]]);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181020_211414_buy_request_dummy_data cannot be reverted.\n";

        return false;
    }
    */
}
