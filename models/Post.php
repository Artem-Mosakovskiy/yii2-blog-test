<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Post extends ActiveRecord
{
    public static function tableName()
    {
        return 'posts';
    }

    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            ['is_public', 'boolean'],
        ];
    }

    public function isAuthorized()
    {
        return $this->is_public || !Yii::$app->user->isGuest;
    }
}

