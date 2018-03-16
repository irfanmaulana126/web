<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;

use kartik\widgets\DatePicker;
use kartik\field\FieldRange;
/* @var $this yii\web\View */
/* @var $model frontend\backend\master\models\ProductPromo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-promo-form">

    <?php $form = ActiveForm::begin(); ?>
    
    
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
        echo $form->field($model,'PERIODE_TGL1',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span><b>Tanggal</b></span>',
							'options'=>['style' =>'border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right']
						]
					]
				])->widget(DatePicker::classname(), [
                    'value'=>$date1,
                    'attribute2' => 'PERIODE_TGL2',
                        'value2'=>$date2,
                        'options' => ['placeholder' => 'Tanggal Awal'],
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
    <?= $form->field($model,'PROMO',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span><b>Promo</b></span>',
							'options'=>['style' =>'border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right;width: 78px;']
						]
					]
				])->textInput(['style'=>'border-radius: 0px 5px 5px 0px;'])->label(false); ?>
            
    
    <div class="form-group text-right">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
