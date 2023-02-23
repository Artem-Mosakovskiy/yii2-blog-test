<?php

namespace app\controllers\Api;

use app\models\Post;
use Yii;
use yii\filters\auth\HttpBearerAuth;

class PostsController extends ApiController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class'    => HttpBearerAuth::className(),
            'optional' => ['list', 'view']
        ];

        return $behaviors;
    }

    public function actionList()
    {
        $posts = Post::find();

        if (Yii::$app->user->isGuest) {
            $posts = $posts->where(['is_public' => true]);
        }

        return [
            'posts' => $posts->all()
        ];
    }

    public function actionView($id)
    {
        $post = Post::findOne($id);

        if (!$post || !$post->isAuthorized()) {
            return ['error' => 'The requested post does not exist'];
        }

        return [
            'post' => $post
        ];
    }
}
