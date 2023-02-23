<?php

use Faker\Factory;
use yii\db\Migration;

/**
 * Class m230223_200605_users_seeder
 */
class m230223_200605_users_seeder extends Migration
{
    public function safeUp()
    {
        $faker = Factory::create();

        $users = [];
        for ($i = 0; $i < 10; $i++) {
            $users[] = [
                'username'      => $faker->userName,
                'password_hash' => Yii::$app->security->generatePasswordHash($faker->password),
                'auth_key'      => Yii::$app->security->generateRandomString(),
            ];
        }

        $this->batchInsert('users', ['username', 'password_hash', 'auth_key'], $users);
    }

    public function safeDown()
    {
        $this->delete('users', []);
    }
}
