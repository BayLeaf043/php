<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\AdminArticle $model */

$this->title = 'Update Admin Article: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Admin Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="admin-article-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
