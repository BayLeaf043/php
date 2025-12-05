<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\AdminArticle $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Admin Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="admin-article-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
            'attribute' => 'user_id',
            'label' => 'ID Автора',
            'value' => $model->user->id ?? '(немає)',
            ],
            [
            'attribute' => 'user_id',
            'label' => 'Автор',
            'value' => $model->user->name ?? '(немає)',
            ],
            [
            'attribute' => 'topic_id',
            'label' => 'ID Категорії',
            'value' => $model->topic->id ?? '(немає)',
            ],
            [
            'attribute' => 'topic_id',
            'label' => 'Категорія',
            'value' => $model->topic->name ?? '(немає)',
            ],
            [
            'attribute' => 'title',
            'label' => 'Заголовок',
            'value' => $model->title ?? '(немає)',
            ],
            [
            'attribute' => 'content',
            'label' => 'Текст статті',
            'value' => $model->content ?? '(немає)',
            ],
            [
            'attribute' => 'image',
            'label' => 'Шлях до зображення',
            'value' => $model->image ?? '(немає)',
            ],
            [
            'attribute' => 'image',
            'label' => 'Зображення',
            'format' => 'html',
            'value' => $model->image
                ? Html::img(
                    Yii::$app->request->baseUrl . '/' . Html::encode($model->image),
                    ['style' => 'max-width:300px; max-height:300px; object-fit:cover;']
                  )
                : '(немає)',
            ],
            [
            'attribute' => 'tags',
            'label' => 'Теги',
            'value' => $model->tags ?? '(немає)',
            ],
            [
            'attribute' => 'views',
            'label' => 'Перегляди',
            'value' => $model->views ?? '(немає)',
            ],
            [
            'attribute' => 'created_at',
            'label' => 'Дата створення',
            'value' => $model->created_at ?? '(немає)',
            ],
        ],
    ]) ?>

</div>
