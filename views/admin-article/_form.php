<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Topic;

/** @var yii\web\View $this */
/** @var app\models\AdminArticle $model */
/** @var yii\widgets\ActiveForm $form */

$topics = ArrayHelper::map(Topic::find()->all(), 'id', 'name');
?>

<div class="admin-article-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'], // важливо для upload
    ]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'topic_id')->dropDownList(
        $topics,
        ['prompt' => 'Оберіть категорію...']
    ) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?php if ($model->image): ?>
        <p>Поточне зображення:</p>
        <p>
            <img src="<?= Yii::$app->request->baseUrl . '/' . Html::encode($model->image) ?>"
                 style="max-width: 200px;">
        </p>
    <?php endif; ?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <?= $form->field($model, 'tags')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('Зберегти', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>