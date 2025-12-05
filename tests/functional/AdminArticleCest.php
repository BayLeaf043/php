<?php

//use app\models\AdminArticle;
namespace tests\functional;

use app\models\User;
use FunctionalTester;
use app\models\AdminArticle;
use Yii;

class AdminArticleCest
{
    public function _before(FunctionalTester $I)
    {
        // Гарантуємо, що є користувач admin123
        $admin = User::findOne(['login' => 'admin123']);

        if (!$admin) {
            $admin = new User();
            $admin->name  = 'Admin';
            $admin->login = 'admin123';

            if (method_exists($admin, 'setPassword')) {
                $admin->setPassword('1234');
            } else {
                $admin->password_hash = Yii::$app->security->generatePasswordHash('1234');
            }

            if (method_exists($admin, 'generateAuthKey')) {
                $admin->generateAuthKey();
            }

            $admin->save(false);
        }

        // Логінимося, щоб мати доступ до адмінки
        Yii::$app->user->login($admin);
    }

    /**
     * READ: перевірка сторінки списку статей в адмінці
     */
    public function ensureIndexPageWorks(FunctionalTester $I)
    {
        $I->amOnRoute('admin-article/index');
        $I->seeResponseCodeIs(200);
        $I->see('Admin Articles');
        $I->see('Create Admin Article');
    }

    /**
     * CREATE: перевірка створення статті в БД через модель
     */
    public function createArticle(FunctionalTester $I)
    {
        $admin = User::findOne(['login' => 'admin123']);

        $article = new AdminArticle();
        $article->title      = 'Тестова стаття';
        $article->content    = 'Тестовий контент для перевірки.';
        $article->topic_id   = 1; 
        $article->tags       = 'test, create';
        $article->views      = 0;
        $article->created_at = date('Y-m-d H:i:s');
        $article->user_id    = $admin->id;

        $article->save(false);

        $I->seeRecord(AdminArticle::class, [
            'title' => 'Тестова стаття',
        ]);
    }

    /**
     * UPDATE: перевірка оновлення статті в БД через модель
     */
    public function updateArticle(FunctionalTester $I)
    {
        $admin = User::findOne(['login' => 'admin123']);

        $article = new AdminArticle();
        $article->title      = 'Стара назва';
        $article->content    = 'Старий текст';
        $article->topic_id   = 1;
        $article->tags       = 'old, tag';
        $article->views      = 0;
        $article->created_at = date('Y-m-d H:i:s');
        $article->user_id    = $admin->id;
        $article->save(false);

        $id = $article->id;

        $article->title   = 'Оновлена назва';
        $article->content = 'Оновлений текст';
        $article->tags    = 'updated, test';
        $article->save(false);

        $I->seeRecord(AdminArticle::class, [
            'id'    => $id,
            'title' => 'Оновлена назва',
        ]);
    }

    /**
     * DELETE: перевірка видалення через actionDelete (через роут)
     */
    public function deleteArticle(FunctionalTester $I)
    {
        $admin = User::findOne(['login' => 'admin123']);

        $article = new AdminArticle();
        $article->title      = 'Стаття для видалення';
        $article->content    = 'Текст для видалення';
        $article->topic_id   = 1;
        $article->views      = 0;
        $article->created_at = date('Y-m-d H:i:s');
        $article->user_id    = $admin->id;
        $article->save(false);

        $id = $article->id;

        $I->seeRecord(AdminArticle::class, ['id' => $id]);

        $I->amOnRoute('admin-article/delete', ['id' => $id]);

        $I->dontSeeRecord(AdminArticle::class, ['id' => $id]);
    }
}