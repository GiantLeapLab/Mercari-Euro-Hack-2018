<?php

use yii\db\Migration;

/**
 * Class m181020_181519_add_image_data
 */
class m181020_181519_add_image_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('image', ['path'], [
            //laptops
            ['image_gallery/apple-macbook-pro.jpg'],
            ['image_gallery/dell-g3-15.jpg'],
            ['image_gallery/dell-xps-13-laptop.jpg'],
            ['image_gallery/hp-15-db00.jpg'],
            ['image_gallery/hp-17t.png'],
            ['image_gallery/huawei-mateBook-x.jpg'],
            ['image_gallery/samsung-np900x3l.jpg'],

            //phones
            ['image_gallery/huawei_nova3i_hdr_3.jpg'],
            ['image_gallery/jio-phone-2.jpeg'],
            ['image_gallery/metro-313.jpg'],
            ['image_gallery/nokia_6_2018_main_1.jpeg'],
            ['image_gallery/razer-phone.jpeg'],
            ['image_gallery/samsung-galaxy-s6.png'],


            /*['image_gallery/'],
            ['image_gallery/'],
            ['image_gallery/'],
            ['image_gallery/'],*/
        ]);

        $this->execute("insert into category_to_image(image_id, category_id)
                              select id, 36
                              from image 
                              where path in (
                              'image_gallery/apple-macbook-pro.jpg',
                              'image_gallery/dell-g3-15.jpg',
                              'image_gallery/dell-xps-13-laptop.jpg',
                              'image_gallery/hp-15-db00.jpg',
                              'image_gallery/hp-17t.png',
                              'image_gallery/huawei-mateBook-x.jpg',
                              'image_gallery/samsung-np900x3l.jpg')"
        );

        $this->execute("insert into category_to_image(image_id, category_id)
                              select id, 40
                              from image 
                              where path in (
                              'image_gallery/huawei_nova3i_hdr_3.jpg',
                              'image_gallery/jio-phone-2.jpeg',
                              'image_gallery/metro-313.jpg',
                              'image_gallery/nokia_6_2018_main_1.jpeg',
                              'image_gallery/razer-phone.jpeg',
                              'image_gallery/samsung-galaxy-s6.png')"
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('image', ['IN', 'path',[
            //laptops
            'image_gallery/apple-macbook-pro.jpg',
            'image_gallery/dell-g3-15.jpg',
            'image_gallery/dell-xps-13-laptop.jpg',
            'image_gallery/hp-15-db00.jpg',
            'image_gallery/hp-17t.png',
            'image_gallery/huawei-mateBook-x.jpg',
            'image_gallery/samsung-np900x3l.jpg',

            //phones
            'image_gallery/huawei_nova3i_hdr_3.jpg',
            'image_gallery/jio-phone-2.jpeg',
            'image_gallery/metro-313.jpg',
            'image_gallery/nokia_6_2018_main_1.jpeg',
            'image_gallery/razer-phone.jpeg',
            'image_gallery/samsung-galaxy-s6.png',

        ]]);
    }
}
