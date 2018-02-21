<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\payment\models\DompetTranscodeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dompet-transcode-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'TRANSCODE') ?>

    <?= $form->field($model, 'TRANS_NM') ?>

    <?= $form->field($model, 'TRANS_DCRP') ?>

    <?= $form->field($model, 'TRANS_TYPE') ?>

    <?= $form->field($model, 'TRANS_TYPE_NM') ?>

    <?php // echo $form->field($model, 'CREATE_BY') ?>

    <?php // echo $form->field($model, 'CREATE_AT') ?>

    <?php // echo $form->field($model, 'UPDATE_BY') ?>

    <?php // echo $form->field($model, 'UPDATE_AT') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
