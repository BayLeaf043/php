<?php

use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\widgets\LinkPager;


$this->registerCssFile('@web/css/article.css');

$this->title = 'Новини ІТ-індустрії';
?>

<h1><?= Html::encode($this->title) ?></h1>

<?php foreach ($articles as $article): ?>

    <div class="article-card">

        <?php if ($article->topic): ?>
            <div class="article-topic">
                <?= Html::encode($article->topic->name) ?>
            </div>
        <?php endif; ?>

        <h2 class="article-title">
            <?= Html::encode($article->title) ?>
        </h2>

        <p class="article-preview">
            <?php
                $preview = StringHelper::truncateWords(strip_tags($article->content), 40, '...');
                echo Html::encode($preview);
            ?>
        </p>

        <p class="article-date">
            Опубліковано:
            <?= Yii::$app->formatter->asDatetime($article->created_at, 'php:d.m.Y H:i') ?>
        </p>

    </div>

<?php endforeach; ?>

<?= LinkPager::widget(['pagination' => $pagination]) ?>