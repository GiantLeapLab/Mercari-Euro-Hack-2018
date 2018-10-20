<?php

use yii\db\Migration;

/**
 * Class m181020_102540_insert_users_data
 */
class m181020_102540_insert_users_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('user', [
            'username' => 'John',
            'auth_key' => Yii::$app->security->generateRandomString(),
        ]);

        $this->insert('user', [
            'username' => 'Mike',
            'auth_key' => Yii::$app->security->generateRandomString(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('user', ['IN', 'username', [
            'Mike', 'John'
        ]]);
    }
}
