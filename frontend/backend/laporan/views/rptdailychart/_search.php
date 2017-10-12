<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\RptDailyChartSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rpt-daily-chart-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'Val_Nm') ?>

    <?= $form->field($model, 'Val_Cnt') ?>

    <?= $form->field($model, 'Val_Json') ?>

    <?= $form->field($model, 'ACCESS_GROUP') ?>

    <?php // echo $form->field($model, 'UPDT') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
