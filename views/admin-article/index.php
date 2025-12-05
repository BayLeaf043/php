<?php

use app\models\AdminArticle;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\AdminArticleSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Admin Articles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-article-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Admin Article', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'id',

        [
            'attribute' => 'user_id',
            'label' => 'Автор',
            'value' => function (AdminArticle $model) {
                return $model->user ? $model->user->name : '(немає)';
            },
        ],

        [
            'attribute' => 'topic_id',
            'label' => 'Категорія',
            'value' => function (AdminArticle $model) {
                return $model->topic ? $model->topic->name : '(немає)';
            },
        ],

        [
            'attribute' => 'title',
            'label' => 'Заголовок',
            'value' => function (AdminArticle $model) {
                return $model->title;
            },
        ],

        [
            'attribute' => 'content',
            'label' => 'Текст статті',
            'value' => function (AdminArticle $model) {
                $text = strip_tags($model->content);
                $short = mb_substr($text, 0, 120);
                if (mb_strlen($text) > 120) {
                    $short .= '…';
                }
                return $short;
            },
            'format' => 'text',
        ],

        [
            'attribute' => 'image',
            'label' => 'Зображення',
            'format' => 'html',
            'value' => function (AdminArticle $model) {
                if ($model->image) {
                    return Html::img(
                        Yii::$app->request->baseUrl . '/' . $model->image,
                        ['style' => 'max-width:80px; max-height:80px; object-fit:cover;']
                    );
                }
                return '(немає)';
            },
        ],

        [
            'attribute' => 'created_at',
            'label' => 'Створено',
            'format' => ['datetime', 'php:d.m.Y H:i'],
        ],

        [
            'class' => ActionColumn::className(),
            'urlCreator' => function ($action, AdminArticle $model, $key, $index, $column) {
                return Url::toRoute([$action, 'id' => $model->id]);
            }
        ],
    ],
]); ?>


</div>
