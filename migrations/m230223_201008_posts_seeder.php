<?php

use yii\db\Migration;

/**
 * Class m230223_201008_posts_seeder
 */
class m230223_201008_posts_seeder extends Migration
{
    public function safeUp()
    {
        $faker = Faker\Factory::create();

        for ($i = 1; $i <= 10; $i++) {
            $this->insert('posts', [
                'title'      => $faker->sentence(6),
                'content'    => $faker->paragraphs(3, true),
                'is_public'  => $faker->boolean(80),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }

    public function safeDown()
    {
        $this->delete('posts');
    }
}
