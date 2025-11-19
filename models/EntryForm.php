<?php

namespace app\models;
use Yii;
use yii\base\Model;

class EntryForm extends Model
{
    public $name;
    public $email;

    public function rules()
    {
        return [
        [
            ['name', 'email'], 
            'required', 
            'message' => 'Поле не може бути порожнім'
        ],

        [
            'email', 
            'email', 
            'message' => 'Невірний формат електронної пошти'
        ],

        [
            'name',
            'string',
            'min' => 3,
            'max' => 50,
            'tooShort' => 'Імʼя повинно містити мінімум 3 символи',
            'tooLong' => 'Імʼя повинно містити максимум 50 символів'
        ],
        ];
    }
}