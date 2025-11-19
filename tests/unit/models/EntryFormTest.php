<?php

namespace tests\unit\models;

use app\models\EntryForm;

class EntryFormTest extends \Codeception\Test\Unit
{
    //Тест: коректні дані повинні проходити валідацію
    public function testValidData()
    {
        $model = new EntryForm();

        $model->name = 'Polina';
        $model->email = 'polinabrazhnyk@gmail.com';

        $this->assertTrue($model->validate(), 'Модель має бути валідною з коректними даними');
    }

    //Тест: порожні поля НЕ повинні проходити валідацію
    public function testEmptyFields()
    {
        $model = new EntryForm();

        $model->name = '';
        $model->email = '';

        $this->assertFalse($model->validate(), 'Модель не повинна бути валідною з порожніми полями');
        $this->assertArrayHasKey('name', $model->errors);
        $this->assertArrayHasKey('email', $model->errors);
    }

    //Тест: неправильний email не проходить валідацію
    public function testInvalidEmail()
    {
        $model = new EntryForm();

        $model->name = 'ValidName';
        $model->email = 'wrong_email_format';

        $this->assertFalse($model->validate(), 'Модель не повинна бути валідною при неправильному email');
        $this->assertArrayHasKey('email', $model->errors);
    }

    //Тест: імʼя занадто коротке
    public function testShortName()
    {
        $model = new EntryForm();

        $model->name = 'Pa'; 
        $model->email = 'test@example.com';

        $this->assertFalse($model->validate(), 'Імʼя з 2 символів не повинно пройти валідацію');
        $this->assertArrayHasKey('name', $model->errors);
    }

    //Тест: імʼя занадто довге (>50)
    public function testLongName()
    {
        $model = new EntryForm();

        $model->name = str_repeat('a', 60); 
        $model->email = 'test@example.com';

        $this->assertFalse($model->validate(), 'Імʼя довше 50 символів не повинно пройти валідацію');
        $this->assertArrayHasKey('name', $model->errors);
    }
}