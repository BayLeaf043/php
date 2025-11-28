<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\LoginForm;
use app\models\SignupForm;

class AuthController extends Controller
{
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', ['model' => $model]);
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionSignup()
    {
        $model = new SignupForm();

        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && $user = $model->signup()) {
                Yii::$app->user->login($user);
                return $this->goHome();
            } else {
                return $this->render('signup', ['model' => $model]);
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }
}