<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\widgets\ActiveForm;
use kartik\money\MaskMoney;
use kartik\widgets\SwitchInput;
use kartik\switchinput\SwitchInputAsset;
use kartik\checkbox\CheckboxX;
/* @var $this yii\web\View */
/* @var $model app\backend\master\models\ItemFdiscount */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-fdiscount-form">
    <?= 
    DetailView::widget([
        'id'=>'dv-data-barang-view',
        'model' => $model,
        'attributes' => [
            [
                'columns' => [
                    [
                        'attribute'=>'NamaKaryawan', 
                        'displayOnly'=>true,
                        'valueColOptions'=>['style'=>'width:80%']
                    ],
                ],
            ],
            [
                'columns' => [
                    [
                        'attribute'=>'KTP', 
                        'displayOnly'=>true,
                        'valueColOptions'=>['style'=>'width:80%']
                    ],
                ],
            ],
            [
                'columns' => [
                    [
                        'attribute'=>'Nomer', 
                        'valueColOptions'=>['style'=>'width:80%'], 
                        'displayOnly'=>true
                    ],
                ],
            ],
            [
                'columns' => [
                    [
                        'attribute'=>'Ttl', 
                        'displayOnly'=>true,
                        'valueColOptions'=>['style'=>'width:80%']
                    ],
                ],
            ],
            [
                'columns' => [
                    [
                        'attribute'=>'ALAMAT', 
                        'displayOnly'=>true,
                        'valueColOptions'=>['style'=>'width:80%']
                    ],
                ],
            ],
            [
                'columns' => [
                    [
                        'attribute'=>'GENDER', 
                        'valueColOptions'=>['style'=>'width:30%'], 
                        'displayOnly'=>true
                    ],
                    
                    [
                        'attribute'=>'STS_NIKAH', 
                        'valueColOptions'=>['style'=>'width:30%'], 
                        'displayOnly'=>true
                    ],
                ],
            ],
            [
                'columns' => [
                    [
                        'attribute'=>'EMAIL', 
                        'displayOnly'=>true,
                        'valueColOptions'=>['style'=>'width:80%']
                    ],
                ],
            ],
        ],
        'hover'=>true,
        'panel'=>[
			'heading'=>'<span class="fa fa-share"><span><b> Detail Karyawan</b>',
			'type'=>DetailView::TYPE_INFO,
		],
        'mode'=>DetailView::MODE_VIEW,
        'buttons1'=>'',
		'buttons2'=>'{view}{save}',		
    ]) ?>
    
</div>
<div class="col-12-xl">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'UPAH_HARIAN')->widget(MaskMoney::classname(), [
                            'pluginOptions'=>[
                                'prefix'=>'Rp ',
                                'precision' => 0
                            ],
                        ]) ?>
            <div class="col-md-6">
            
            <?= $form->field($model, 'STT_POT_TELAT')->widget(CheckboxX::classname(),[
                'value'=>empty($model->STT_POT_TELAT) ? '0' : '1',
                'pluginOptions'=>['threeState'=>false]
                ]); ?>

            <?= $form->field($model, 'STT_POT_PULANG')->widget(CheckboxX::classname(),[
                'value'=>empty($model->STT_POT_PULANG) ? '0' : '1',
                'pluginOptions'=>['threeState'=>false]
                ]); ?>
            
            </div>
            <div class="col-md-6">
            
            <?= $form->field($model, 'STT_IZIN')->widget(CheckboxX::classname(),[
                'value'=>empty($model->STT_IZIN) ? '0' : '1',
                'pluginOptions'=>['threeState'=>false]
                ]); ?>

            <?= $form->field($model, 'STT_LEMBUR')->widget(CheckboxX::classname(),[
                'value'=>empty($model->STT_LEMBUR) ? '0' : '1',
                'pluginOptions'=>['threeState'=>false]
                ]);?>

            </div>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

    <?php ActiveForm::end(); ?>
    </div>