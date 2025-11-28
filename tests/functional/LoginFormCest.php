<?php

namespace tests\functional;

use app\models\User;
use FunctionalTester;
use Yii;

class LoginFormCest
{
    public function _before(FunctionalTester $I)
    {
        $login = 'testlogin';
        $user = User::find()->where(['login' => $login])->one();

        if ($user === null) {
            $user = new User();
            $user->name = 'Тестовий Користувач';
            $user->login = $login;
            $user->password_hash = Yii::$app->security->generatePasswordHash('testpass');
            $user->auth_key = Yii::$app->security->generateRandomString();
            $user->save(false);
        }
    }

    public function ensureLoginPageOpens(FunctionalTester $I)
    {
        $I->amOnRoute('auth/login');
        $I->see('Вхід до системи', 'h2');
    }

    public function loginWithEmptyFields(FunctionalTester $I)
    {
        $I->amOnRoute('auth/login');
        $I->click('Увійти');
        $I->see('Це поле є обов’язковим');
    }

    public function loginWithWrongPassword(FunctionalTester $I)
    {
        $I->amOnRoute('auth/login');

        $I->fillField('LoginForm[login]', 'testlogin');
        $I->fillField('LoginForm[password]', 'wrong');
        $I->click('Увійти');

        $I->see('Невірний логін або пароль.');
    }

    public function loginSuccessfully(FunctionalTester $I)
    {
        $I->amOnRoute('auth/login');

        $I->fillField('LoginForm[login]', 'testlogin');
        $I->fillField('LoginForm[password]', 'testpass');
        $I->click('Увійти');

        $I->see('Вийти (testlogin)');
    }
}