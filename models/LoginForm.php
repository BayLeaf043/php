<?php

namespace app\models;

use Yii;
use yii\base\Model;

class LoginForm extends Model
{
    public $login;
    public $password;
    public $rememberMe = true;

    private $_user = null;

    public function rules()
    {
        return [
        [['login', 'password'], 'required',
            'message' => 'Це поле є обов’язковим'],
        
        ['rememberMe', 'boolean'],

        ['password', 'validatePassword'],
    ];
    }

    public function attributeLabels()
    {
        return [
            'login' => 'Логін',
            'password' => 'Пароль',
            'rememberMe' => 'Запам’ятати мене',
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if ($this->hasErrors()) {
            return;
        }

        $user = $this->getUser();

        if (!$user || !$user->validatePassword($this->password)) {
            $this->addError($attribute, 'Невірний логін або пароль.');
        }
    }

    public function login(): bool
    {
        if ($this->validate()) {
            return Yii::$app->user->login(
                $this->getUser(),
                $this->rememberMe ? 3600 * 24 * 30 : 0
            );
        }

        return false;
    }

    protected function getUser(): ?User
    {
        if ($this->_user === null) {
            $this->_user = User::findByLogin($this->login);
        }
        return $this->_user;
    }
}