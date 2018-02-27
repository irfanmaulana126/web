<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\JurnalTemplateDetailSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jurnal-template-detail-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'RPT_DETAIL_ID') ?>

    <?= $form->field($model, 'RPT_SORTING') ?>

    <?= $form->field($model, 'ACCESS_GROUP') ?>

    <?= $form->field($model, 'AKUN_CODE') ?>

    <?= $form->field($model, 'KTG_CODE') ?>

    <?php // echo $form->field($model, 'AKUN_NM') ?>

    <?php // echo $form->field($model, 'KTG_NM') ?>

    <?php // echo $form->field($model, 'RPT_TITLE_ID') ?>

    <?php // echo $form->field($model, 'RPT_TITLE_NM') ?>

    <?php // echo $form->field($model, 'RPT_GROUP_ID') ?>

    <?php // echo $form->field($model, 'RPT_GROUP_NM') ?>

    <?php // echo $form->field($model, 'CAL_FORMULA') ?>

    <?php // echo $form->field($model, 'CAL_FORMULA_NM') ?>

    <?php // echo $form->field($model, 'STATUS') ?>

    <?php // echo $form->field($model, 'STATUS_NM') ?>

    <?php // echo $form->field($model, 'KETERANGAN') ?>

    <?php // echo $form->field($model, 'CREATE_BY') ?>

    <?php // echo $form->field($model, 'UPDATE_BY') ?>

    <?php // echo $form->field($model, 'CREATE_AT') ?>

    <?php // echo $form->field($model, 'UPDATE_AT') ?>

    <?php // echo $form->field($model, 'MONTH_AT') ?>

    <?php // echo $form->field($model, 'YEAR_AT') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
