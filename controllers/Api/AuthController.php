<?php

namespace app\controllers\Api;

use app\models\LoginForm;
use Yii;

class AuthController extends ApiController
{
    public function actionLogin()
    {
        $model = new LoginForm();
        $model->load(Yii::$app->getRequest()->getBodyParams(), '');

        if ($model->validate() && $model->login()) {
            return [
                'access_token' => Yii::$app->user->identity->getAuthKey()
            ];
        } else {
            return [
                'error' => $model->getErrors()
            ];
        }
    }
}
