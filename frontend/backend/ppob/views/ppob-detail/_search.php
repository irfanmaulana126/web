<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\ppob\models\PpobDetailSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ppob-detail-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'DETAIL_ID') ?>

    <?= $form->field($model, 'HEADER_ID') ?>

    <?= $form->field($model, 'PROVIDER_ID') ?>

    <?= $form->field($model, 'DETAIL_NM') ?>

    <?php // echo $form->field($model, 'PROVIDER_NM') ?>

    <?php // echo $form->field($model, 'DETAIL_DCRP') ?>

    <?php // echo $form->field($model, 'STATUS') ?>

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
