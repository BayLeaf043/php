<?php

namespace app\models;

use Yii;
use yii\base\Model;

class SignupForm extends Model
{
    public $name;
    public $login;
    public $password;

    public function rules()
    {
        return [
        [['name', 'login', 'password'], 'required',
            'message' => 'Це поле не може бути порожнім.'],

        [['name', 'login'], 'string', 'max' => 255],

        ['login', 'match', 'pattern' => '/^[a-zA-Z0-9_]+$/u',
            'message' => 'Логін може містити тільки латинські літери, цифри та _.'],

        ['login', 'unique',
            'targetClass' => \app\models\User::class,
            'targetAttribute' => 'login',
            'message' => 'Такий логін вже використовується.'],

        ['password', 'string', 'min' => 4,
            'tooShort' => 'Пароль має містити щонайменше 4 символи.'],
    ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Ім’я',
            'login' => 'Логін',
            'password' => 'Пароль',
        ];
    }

    public function signup(): ?User
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->name = $this->name;
        $user->login = $this->login;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->created_at = date('Y-m-d H:i:s');

        return $user->save() ? $user : null;
    }
}