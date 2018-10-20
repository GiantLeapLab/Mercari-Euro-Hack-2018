<?php

use yii\db\Migration;

/**
 * Class m181020_214635_update_buy_request_dummy_data
 */
class m181020_214635_update_buy_request_dummy_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->delete('buy_request', ['IN', 'user_id',[2]]);
        $this->batchInsert('buy_request', ['user_id', 'title', 'min_price', 'max_price', 'description', 'category_id'],[

            [2, 'laptop', '305', '457', 'I would like to buy something cheap', 36],
            [2, 'awesome  laptop', '310', '550', '', 36],
            [2, 'pink  laptop', '500', '800', '', 36],
            [2, 'laptop for child', '800', '1235', '', 36],
            [2, 'laptop ', '400', '650', '', 36],
            [2, 'laptop ', '301', '450', '', 36],

            [2, 'phone', '52', '80', '', 40],
            [2, 'awesome  phone', '55', '75', '', 40],
            [2, 'yellow phone', '51', '55', '', 40],
            [2, 'phone for grandma', '58', '99', '', 40],

            [2, 'mug', '5', '9', '', 25],
            [2, 'tea cup', '7', '15', '', 25],
            [2, 'big cup', '6', '10', '', 25],
            [2, 'happy cup', '10', '20', '', 25],
            [2, 'happy cup', '15', '25', '', 25],


            [2, 'apple mouse', '15', '25', '', 37],
            [2, 'game mouse', '18', '33', '', 37],
            [2, 'black mouse', '16', '26', '', 37],
            [2, 'working mouse', '15', '20', '', 37],
            [2, 'apple mouse', '19', '21', '', 37],
            [2, 'game mouse', '17', '37', '', 37],
            [2, 'black mouse', '88', '99', '', 37],
            [2, 'working mouse', '75', '100', '', 37],

            [2, 'glass bottle', '1', '3', '', 23],
            [2, 'empty bottle', '2', '5', '', 23],
            [2, 'cooler bottle', '1', '2', '', 23],
            [2, 'clean bottle', '1', '3', '', 23],
            [2, 'glass bottle', '1', '2', '', 23],
            [2, 'empty bottle', '2', '5', '', 23],
            [2, 'cooler bottle', '2', '5', '', 23],
            [2, 'clean bottle', '1', '3', '', 23],
            [2, 'glass bottle', '1', '2', '', 23],
            [2, 'empty bottle', '2', '7', '', 23],


            [2, 'children book', '10', '20', '', 46],
            [2, 'harry potter', '15', '25', '', 46],
            [2, 'As the Steel Was Tempered', '20', '45', '', 46],
            [2, 'dev book', '15', '50', '', 46],
            [2, 'children book', '50', '70', '', 46],
            [2, 'harry potter', '55', '95', '', 46],
            [2, 'As the Steel Was Tempered', '45', '60', '', 46],
            [2, 'dev book', '35', '70', '', 46],
            [2, 'children book', '40', '60', '', 46],
            [2, 'harry potter', '75', '100', '', 46],
            [2, 'As the Steel Was Tempered', '15', '19', '', 46],
            [2, 'dev book', '50', '70', '', 46],

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
        echo "m181020_214635_update_buy_request_dummy_data cannot be reverted.\n";

        return false;
    }
    */
}
