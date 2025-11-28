<?php

namespace tests\functional;

use FunctionalTester;
use app\models\User;
use Yii;

class SignupCest
{
    public function ensureSignupPageOpens(FunctionalTester $I)
    {
        $I->amOnRoute('auth/signup');
        $I->see('Реєстрація', 'h2');
    }

    public function validateRequiredFields(FunctionalTester $I)
    {
        $I->amOnRoute('auth/signup');
        $I->click('Зареєструватися');

        $I->see('Це поле не може бути порожнім.');
    }

    public function validateLoginPattern(FunctionalTester $I)
    {
        $I->amOnRoute('auth/signup');

        $I->fillField('SignupForm[name]', 'Test');
        $I->fillField('SignupForm[login]', 'логін_укр'); 
        $I->fillField('SignupForm[password]', '12345');

        $I->click('Зареєструватися');

        $I->see('Логін може містити тільки латинські літери, цифри та _.');
    }

    public function validateLoginUnique(FunctionalTester $I)
    {
        $user = new User();
        $user->name = 'Test User';
        $user->login = 'existing_user';
        $user->password_hash = \Yii::$app->security->generatePasswordHash('qwerty');
        $user->auth_key = \Yii::$app->security->generateRandomString();
        $user->save(false);

        $I->amOnRoute('auth/signup');

        $I->fillField('SignupForm[name]', 'Another User');
        $I->fillField('SignupForm[login]', 'existing_user'); 
        $I->fillField('SignupForm[password]', 'qwerty');

        $I->click('Зареєструватися');

        $I->see('Такий логін вже використовується.');
    }

    public function validatePasswordMinLength(FunctionalTester $I)
    {
        $I->amOnRoute('auth/signup');

        $I->fillField('SignupForm[name]', 'Test User');
        $I->fillField('SignupForm[login]', 'validlogin');
        $I->fillField('SignupForm[password]', '12'); 

        $I->click('Зареєструватися');

        $I->see('Пароль має містити щонайменше 4 символи.');
    }

    public function signupSuccessfully(FunctionalTester $I)
    {
        $I->amOnRoute('auth/signup');

        $login = 'user_' . time(); 

        $I->fillField('SignupForm[name]', 'Нове Імʼя');
        $I->fillField('SignupForm[login]', $login);
        $I->fillField('SignupForm[password]', 'qwerty');

        $I->click('Зареєструватися');

        $I->see("Вийти ($login)");
    }
}