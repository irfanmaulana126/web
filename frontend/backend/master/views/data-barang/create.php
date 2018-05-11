<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\select2\Select2;
use common\models\Store;
use kartik\widgets\FileInput;
use kartik\widgets\DatePicker;
use kartik\field\FieldRange;
use frontend\backend\master\models\Supplier;
use yii\helpers\ArrayHelper;
use kartik\money\MaskMoney;
use kartik\widgets\ColorInput;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
use yii\web\View;
$warnaLabel='rgba(21, 175, 213, 0.14)';
$widthLabel='155px';
$this->registerJs($this->render('form.js'));
$this->registerJs("

$(document).ready(function() {
	$('#hitung').change(function(){
    var hpp=parseInt($('#productharga-hpp').val());
    var ppn=parseInt($('#productharga-ppn').val());
    var margin=parseInt($('#margin').val());
    var hppbersih=hpp+margin;
    if (!isNaN(hppbersih)) {
        $('#productharga-harga_jual-disp').val(hppbersih);
        $('#productharga-harga_jual').val(hppbersih);
     }
	
	});
});
");
    $this->registerCss("
    body {
        margin-top:30px;
    }
    .stepwizard-step p {
        margin-top: 0px;
        color:#666;
    }
    .stepwizard-row {
        display: table-row;
    }
    .stepwizard {
        display: table;
        width: 100%;
        position: relative;
    }
    .stepwizard-step button[disabled] {
        /*opacity: 1 !important;
        filter: alpha(opacity=100) !important;*/
    }
    .stepwizard .btn.disabled, .stepwizard .btn[disabled], .stepwizard fieldset[disabled] .btn {
        opacity:1 !important;
        color:#bbb;
    }
    .stepwizard-row:before {
        top: 14px;
        bottom: 0;
        position: absolute;
        content:' ';
        width: 100%;
        height: 1px;
        background-color: #ccc;
        z-index: 0;
    }
    .stepwizard-step {
        display: table-cell;
        text-align: center;
        position: relative;
    }
    .btn-circle {
        width: 30px;
        height: 30px;
        text-align: center;
        padding: 6px 0;
        font-size: 12px;
        line-height: 1.428571429;
        border-radius: 15px;
    }
    ");
?>

    <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step col-xs-4"> 
                <a href="#step-1" type="button" class="btn btn-success btn-circle">1</a>
                <p><small>DATA PRODUK</small></p>
            </div>
            <div class="stepwizard-step col-xs-4"> 
                <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                <p><small>HARGA PRODUK</small></p>
            </div>
            <div class="stepwizard-step col-xs-4"> 
                <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                <p><small>STOCK PRODUK</small></p>
            </div>
        </div>
    </div>
    
    <?php $form = ActiveForm::begin([
	'options'=>['enctype'=>'multipart/form-data'],
	]); ?>	
        <div class="panel panel-primary setup-content" id="step-1">
            <div class="panel-heading">
                 <h3 class="panel-title">DATA PRODUK</h3>
            </div>
            <div class="panel-body">
                <?= $form->field($model, 'STORE_ID',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span ><b>Toko</b></span>',
							'options'=>['style' =>'
											background-color:'.$warnaLabel.';
											width:'.$widthLabel.';
											text-align:right;
											border-top-left-radius:5px;
											border-bottom-left-radius:5px;
										']
						]
					]
				])->widget(Select2::classname(),[
            'data'=>ArrayHelper::map(Store::find()->where(['ACCESS_GROUP'=>Yii::$app->user->identity->ACCESS_GROUP,'STATUS'=>['1','0']])->all(),'STORE_ID','STORE_NM'),'language' => 'en',
            'options' => ['placeholder'=>'Pilih Toko....','id'=>'store'],
            'pluginOptions' => [
                'allowClear' => true
            ], 
        ])->label(false)?>
		
		<?= $form->field($model, 'GROUP_ID',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span ><b>GROUP PPRODUK</b></span>',
							'options'=>['style' =>' border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right;width:157px;']
						]
					]
				])->widget(DepDrop::classname(), [
					'type'=>DepDrop::TYPE_SELECT2,
					'options'=>['id'=>'group'],
					'pluginOptions'=>[
						'depends'=>['store'],
						'placeholder'=>'Select...',
						'url'=>Url::to(['/master/data-barang/group'])
					]
				])->label(false) ; ?>

			<?= $form->field($model, 'PRODUCT_NM',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span ><b>Produk</b></span>',
							'options'=>['style' =>' 
											background-color:'.$warnaLabel.';
											width:450px;
											text-align:right;
											border-top-left-radius:5px;
											border-bottom-left-radius:5px;
										']
						]
					]
				])->textInput(['style'=>'text-transform:uppercase;width:410px'])->label(false) ?>
                <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
            </div>
        </div>
        
        <div class="panel panel-primary setup-content" id="step-2">
            <div class="panel-heading">
                 <h3 class="panel-title">HARGA PRODUK</h3>
            </div>
            <div class="panel-body" id="hitung">
            <?php
         if (empty($product->PERIODE_TGL2)) {
            $date = date('Y-m-d');
        } else {
            if ($product->PERIODE_TGL2 < date('Y-m-d')) {
                $date = date('Y-m-d');
            } else {
                $date = date('Y-m-d', strtotime('+1 days', strtotime($product->PERIODE_TGL2)));
            }
            
        }
        $date1=date('Y-m-d');
        $date2=date('Y-m-d', strtotime('+21 days', strtotime($date1)));
        echo $form->field($modelharga,'PERIODE_TGL1',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span><b>Tanggal</b></span>',
							'options'=>['style' =>'border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right;width: 105px;']
						]
					]
				])->widget(DatePicker::classname(), [
                    
                    'attribute2' => 'PERIODE_TGL2',
                        
                        'options' => ['placeholder' => 'Tanggal Awal','value'=>$date],
                        'options2' => ['placeholder' => 'Tanggal Akhir'],
                        'type' => DatePicker::TYPE_RANGE,
                        'form' => $form,
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd',
                            "startDate" => $date,
                            'style'=>'border-radius: 0px 5px 5px 0px;'
                            
                        ]
                    ])->label(false);	
		?>     
     <?= $form->field($modelharga, 'HPP',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span><b>HPP</b></span>',
							'options'=>['style' =>'border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right;width: 105px;']
						]
					]
				])->widget(MaskMoney::classname(), [
                            'options' => ['placeholder' => 'HPP ...','style'=>';width: 415px;border-radius: 0px 5px 5px 0px;'],
                            'pluginOptions'=>[
                                'prefix'=>'Rp ',
                                'precision' => 0
                            ],
                        ])->label(false) ?>
     <?= $form->field($modelharga, 'margin',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span><b>Margin Laba</b></span>',
							'options'=>['style' =>'border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right;width: 105px;']
						]
					]
				])->widget(MaskMoney::classname(), [
		'options' => [
					'placeholder' => 'Margin Harga ...','style'=>';width: 415px;border-radius: 0px 5px 5px 0px;',
					'class' => 'form-control',
					'id'=>'margin',
				],'pluginOptions' => [
					'prefix' => 'Rp ',
					'precision' => 0
				 ]
				])->label(false); ?>
    <?= $form->field($modelharga, 'HARGA_JUAL',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span><b>Harga Jual</b></span>',
							'options'=>['style' =>'border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right;width: 105px;']
						]
					]
				])->widget(MaskMoney::classname(), [
                'options' => ['placeholder' => 'Harga Barang ...','style'=>';width: 415px;border-radius: 0px 5px 5px 0px;','readonly'=>TRUE],
                // 'disabled' => true,
                'pluginOptions'=>[
                    'prefix'=>'Rp ',
                    'precision' => 0
                ],
            ])->label(false) ?>
                <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
            </div>
        </div>
        
        <div class="panel panel-primary setup-content" id="step-3">
            <div class="panel-heading">
                 <h3 class="panel-title">STOCK PRODUK</h3>
            </div>
            <div class="panel-body">
            <?= $form->field($modelstock, 'SUPPLIER_ID',[
					'addon' => [
						'prepend' => [
							'content'=>'<span><b>Supplier</b></span>',
							'options'=>['style' =>'border-radius: 5px 0px 0px 5px;background-color:rgba(21, 175, 213, 0.14);width:100px;text-align:right']
						]
					],		
				])->widget(Select2::classname(),[				
				'data'=>ArrayHelper::map(Supplier::find()->where(['ACCESS_GROUP'=>Yii::$app->user->identity->ACCESS_GROUP,'STATUS'=>['1']])->all(),'SUPPLIER_ID','SUPPLIER_NM'),'language' => 'en',
				'options' => ['placeholder'=>'Select Category....','style'=>'border-radius: 0px 5px 5px 0px;'],
				'pluginOptions' => [
					'allowClear' => true,					
				], 
				
			])->label(false)
		?>
		 <?=$form->field($modelstock,'INPUT_STOCK',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span><b>Input Stock</b></span>',
							'options'=>['style' =>'border-radius: 5px 0px 0px 5px;background-color:rgba(21, 175, 213, 0.14);width:100px;text-align:right']
						]
					]
				])->textInput([
					'type'=>'number',
					'min'=>1,
					'allowEmpty' => true,
					'integerOnly' => false,
                    'style'=>'border-radius: 0px 5px 5px 0px;width:435px;'
				])->label(false);	
		?>    
                <div class="form-group text-right">
                    <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>