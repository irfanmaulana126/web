<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\payment\models\DompetTranscode */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dompet-transcode-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'TRANSCODE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TRANS_NM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TRANS_DCRP')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'TRANS_TYPE')->textInput() ?>

    <?= $form->field($model, 'TRANS_TYPE_NM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CREATE_BY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CREATE_AT')->textInput() ?>

    <?= $form->field($model, 'UPDATE_BY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'UPDATE_AT')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
