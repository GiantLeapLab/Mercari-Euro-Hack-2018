<?php

use yii\db\Migration;

/**
 * Class m181020_165917_add_category_to_image_table
 */
class m181020_165917_add_category_to_image_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('category_to_image', [
            'category_id' => $this->integer()->notNull(),
            'image_id' => $this->integer()->notNull(),

        ]);

        $this->addForeignKey('image_category', 'category_to_image', 'category_id', 'category', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('image_to_images', 'category_to_image', 'image_id', 'image', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('image_category', 'category_to_image');
        $this->dropForeignKey('image_to_images', 'category_to_image');
        $this->dropTable('category_to_image');
    }
}
