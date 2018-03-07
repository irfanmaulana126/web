<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\field\FieldRange;
use kartik\widgets\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model frontend\backend\hris\models\HrdSettingJamkerja */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hrd-setting-jamkerja-form">

    <?php $form = ActiveForm::begin(); ?>
           <div class="col-md-12">
                    <?= FieldRange::widget([
                        'form' => $form,
                        'model' => $model,
                        'label' => 'JARAK WAKTU AWAL KE WAKTU AKHIR',
                        'attribute1' => 'SHIFT_IN',
                        'attribute2' => 'SHIFT_OUT',
                        'type' => FieldRange::INPUT_TIME,
                        'widgetOptions1' => [
                            'pluginOptions' => [
                                'showSeconds' => true,
                                'showMeridian' => false,
                                'minuteStep' => 1,
                                'secondStep' => 5,
                            ]
                        ],
                        'widgetOptions2' => [
                            'pluginOptions' => [
                                'showSeconds' => true,
                                'showMeridian' => false,
                                'minuteStep' => 1,
                                'secondStep' => 5,
                            ]
                        ],
                    ]); ?>
                </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
