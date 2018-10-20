<?php

use yii\db\Migration;

/**
 * Class m181020_104525_insert_categories_data
 */
class m181020_104525_insert_categories_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('category', ['name'], [
            ['bicycle'],
            ['car'],
            ['motorcycle'],
            ['airplane'],
            ['bus'],
            ['boat'],
            ['bench'],
            ['backpack'],
            ['umbrella'],
            ['handbag'],
            ['tie'],
            ['suitcase'],
            ['frisbee'],
            ['skis'],
            ['snowboard'],
            ['sports ball'],
            ['kite'],
            ['baseball bat'],
            ['baseball glove'],
            ['skateboard'],
            ['surfboard'],
            ['tennis racket'],
            ['bottle'],
            ['wine glass'],
            ['cup'],
            ['fork'],
            ['knife'],
            ['spoon'],
            ['bowl'],
            ['chair'],
            ['couch'],
            ['potted plant'],
            ['bed'],
            ['dining table'],
            ['tv'],
            ['laptop'],
            ['mouse'],
            ['remote'],
            ['keyboard'],
            ['cell phone'],
            ['microwave'],
            ['oven'],
            ['toaster'],
            ['sink'],
            ['refrigerator'],
            ['book'],
            ['clock'],
            ['vase'],
            ['scissors'],
            ['teddy bear'],
            ['hair drier'],
            ['toothbrush'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('category', ['IN', 'name',[
            'bicycle',
            'car',
            'motorcycle',
            'airplane',
            'bus',
            'boat',
            'bench',
            'backpack',
            'umbrella',
            'handbag',
            'tie',
            'suitcase',
            'frisbee',
            'skis',
            'snowboard',
            'sports ball',
            'kite',
            'baseball bat',
            'baseball glove',
            'skateboard',
            'surfboard',
            'tennis racket',
            'bottle',
            'wine glass',
            'cup',
            'fork',
            'knife',
            'spoon',
            'bowl',
            'chair',
            'couch',
            'potted plant',
            'bed',
            'dining table',
            'tv',
            'laptop',
            'mouse',
            'remote',
            'keyboard',
            'cell phone',
            'microwave',
            'oven',
            'toaster',
            'sink',
            'refrigerator',
            'book',
            'clock',
            'vase',
            'scissors',
            'teddy bear',
            'hair drier',
            'toothbrush',
        ]]);
    }
}
