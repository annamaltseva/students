<?php

use yii\db\Migration;
use app\models\User;

class m170508_092039_create_admin extends Migration
{
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $user = new User();
        $user->attributes = [
            'id' => 1,
            'email' => 'admin@admin.com',
            'username' => 'admin',
            'name' => 'Администратор',
            'auth_key' => '5htkQZVMtCvnkzt-MbEF67xLnjGf0s4j',
            'is_admin' => 1
        ];
        $user->generateAuthKey();
        $user->setPassword('admin');
        if (!$user->save()) {
            var_dump($user->getFirstErrors());
            throw new Exception();
        }
    }

    public function safeDown()
    {
        User::deleteAll();
    }
}
