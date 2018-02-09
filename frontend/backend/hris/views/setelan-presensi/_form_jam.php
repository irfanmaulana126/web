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

    <?php //print_r(count($data));die();
    $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ACCESS_GROUP')->hiddenInput(['maxlength' => true])->label(false) ?>

    <?= $form->field($model, 'STORE_ID')->hiddenInput(['maxlength' => true])->label(false) ?>

    <?php $i=1;
    if (count($data)>0) {?>
        <?php foreach ($data as $key => $value) { ?>
            <?php //print_r($value['SHIFT_ID']);die();?>
            <?php if ($i==1) {?>
               <?php echo '<label class="control-label">SHIFT '.$i.'</label>';?>
                    <?= $form->field($model, 'SHIFT_ID')->hiddenInput(['value'=>$value['SHIFT_ID']])->label(false) ?>
                
                <div class="col-md-12">
                    <?= FieldRange::widget([
                        'form' => $form,
                        'model' => $model,
                        'label' => 'Enter time range',
                        'attribute1' => 'SHIFT_IN',
                        'attribute2' => 'SHIFT_OUT',
                        'type' => FieldRange::INPUT_TIME,
                        
                    ]); ?>
                </div>
    <?php }else { ?>
                
               <?php echo '<label class="control-label">SHIFT '.$i.'</label>';?>
                    <?= $form->field($model, 'SHIFT_ID')->hiddenInput(['value'=>$value['SHIFT_ID']])->label(false) ?>
                
                <div class="col-md-6">
                    <?= $form->field($model, 'SHIFT_IN')->textInput(['readOnly'=> true]) ?>
                </div>
                
                <div class="col-md-6">
                    <?= $form->field($model, 'SHIFT_OUT')->textInput(['readOnly'=> true]) ?>
                </div>
    <?php }
    $i++ ?>
    <?php } ?>
    <?php } ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
