<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\JurnalAkunSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jurnal-akun-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'AKUN_CODE') ?>

    <?= $form->field($model, 'AKUN_NM') ?>

    <?= $form->field($model, 'KTG_CODE') ?>

    <?= $form->field($model, 'KTG_NM') ?>

    <?= $form->field($model, 'STATUS') ?>

    <?php // echo $form->field($model, 'KETERANGAN') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
