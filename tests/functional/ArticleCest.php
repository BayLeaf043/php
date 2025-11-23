<?php

namespace tests\functional;

class ArticleCest
{
    public function ensureIndexPageWorks(\FunctionalTester $I)
    {
        // маршрут article/index
        $I->amOnRoute('article/index');

        // сторінка відкрилась
        $I->seeResponseCodeIs(200);

        // заголовок сторінки
        $I->see('Новини ІТ-індустрії', 'h1');

        // одна з тестових статей
        $I->see('Збій Cloudflare: як помилка в одному файлі “поклала” світовий інтернет');

        // категорія
        $I->see('Штучний інтелект');
    }
}