<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\JurnalAkun */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jurnal-akun-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'AKUN_CODE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AKUN_NM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KTG_CODE')->textInput() ?>

    <?= $form->field($model, 'KTG_NM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STATUS')->textInput() ?>

    <?= $form->field($model, 'KETERANGAN')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
