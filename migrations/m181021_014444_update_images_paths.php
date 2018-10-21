<?php

use yii\db\Migration;

/**
 * Class m181021_014444_update_images_paths
 */
class m181021_014444_update_images_paths extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("update image set path = substring(path, locate('/',path)+1)");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute("update image set path = concat('image_gallery/', path)");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181021_014444_update_images_paths cannot be reverted.\n";

        return false;
    }
    */
}
