<?php

namespace app\controllers;

use yii\web\Controller;
use yii\data\Pagination;
use app\models\Article;

class ArticleController extends Controller
{
    public function actionIndex()
    {
        $query = Article::find()
            ->with('topic')                  
            ->orderBy(['created_at' => SORT_DESC]);

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $articles = $query
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'articles' => $articles,
            'pagination' => $pagination,
        ]);
    }
}