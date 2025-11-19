<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<style>
    .has-error input {
        border-color: #e74c3c !important;
        background: #fff6f6;
    }

    .help-block {
        color: #e74c3c;
        font-size: 14px;
        margin-top: 5px;
    }
    .form-wrapper {
        max-width: 420px;
        margin: 40px auto;
        background: #f7faff;
        padding: 25px 30px;
        border-radius: 14px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        border: 1px solid #e0e8f5;
    }
    h2 {
        text-align: center;
        font-weight: 600;
        margin-bottom: 20px;
        color: #3b4b71;
    }
    .btn-primary {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border-radius: 8px;
    }
</style>

<div class="form-wrapper">
    <h2>Введіть інформацію</h2>

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->errorSummary($model) ?>

        <?= $form->field($model, 'name')->textInput(['placeholder' => 'Ваше імʼя']) ?>

        <?= $form->field($model, 'email')->textInput(['placeholder' => 'email@example.com']) ?>

        <div class="form-group">
            <?= Html::submitButton('Надіслати', ['class' => 'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end(); ?>
</div>