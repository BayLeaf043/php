<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\AdminArticle $model */

$this->title = 'Create Admin Article';
$this->params['breadcrumbs'][] = ['label' => 'Admin Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-article-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
