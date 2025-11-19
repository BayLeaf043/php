<?php
use yii\helpers\Html;
?>

<style>
    .confirm-box {
        max-width: 500px;
        margin: 40px auto;
        padding: 25px 30px;
        background: #f1fff4;
        border: 1px solid #cceccb;
        border-radius: 14px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.12);
    }
    h2 {
        text-align: center;
        color: #2d6632;
        margin-bottom: 20px;
    }
    ul li {
        font-size: 17px;
        margin-bottom: 8px;
    }
</style>

<div class="confirm-box">
    <h2>Отримані дані</h2>

    <ul>
        <li><strong>Ім’я:</strong> <?= Html::encode($model->name) ?></li>
        <li><strong>Email:</strong> <?= Html::encode($model->email) ?></li>
    </ul>
</div>