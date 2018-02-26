<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\JurnalTambahan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jurnal-tambahan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'JURNAL_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ACCESS_GROUP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STORE_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TRANS_DATE')->textInput() ?>

    <?= $form->field($model, 'STT_PAY')->textInput() ?>

    <?= $form->field($model, 'STT_PAY_NM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AKUN_CODE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AKUN_NM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KTG_CODE')->textInput() ?>

    <?= $form->field($model, 'KTG_NM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'JUMLAH_TOTAL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'JUMLAH_PEMBAGIAN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FREKUENSI')->textInput() ?>

    <?= $form->field($model, 'FREKUENSI_NM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RANGE_TGL1')->textInput() ?>

    <?= $form->field($model, 'RANGE_TGL2')->textInput() ?>

    <?= $form->field($model, 'CREATE_AT')->textInput() ?>

    <?= $form->field($model, 'UPDATE_AT')->textInput() ?>

    <?= $form->field($model, 'MONTH_AT')->textInput() ?>

    <?= $form->field($model, 'YEAR_AT')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
