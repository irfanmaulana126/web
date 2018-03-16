<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\field\FieldRange;
use kartik\widgets\Spinner;

$user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
?>

<div class="item-form">

    <?php $form = ActiveForm::begin(); ?>
   
    <?= $form->field($model, 'POT_RUPIAH')->textInput()->label("POTONGAN RUPIAH") ?>

    <?=FieldRange::widget([
    'form' => $form,
    'model' => $model,
    'label' => 'JARAK WAKTU AWAL KE WAKTU AKHIR',
    'attribute1' => 'POT_JAM1',
    'attribute2' => 'POT_JAM2',
    'type' => FieldRange::INPUT_TIME,
    'widgetOptions1' => [
        'pluginOptions' => [
            'showSeconds' => true,
            'showMeridian' => false,
            'minuteStep' => 1,
            'secondStep' => 5,
            'placeholder'=>['JAM AWAL']
        ]
    ],
    'widgetOptions2' => [
        'pluginOptions' => [
            'showSeconds' => true,
            'showMeridian' => false,
            'minuteStep' => 1,
            'secondStep' => 5,
            'placeholder'=>['JAM AKHIR']
        ]
    ],
]); ?>
   
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
