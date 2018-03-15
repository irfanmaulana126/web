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
							'content'=>'<span >Tanggal</span>',
							'options'=>['style' =>' background-color: lightblue;text-align:right']
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
                        ]
                    ])->label(false);	
		?>  
    <?= $form->field($model,'PROMO',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span >PROMO</span>',
							'options'=>['style' =>' background-color: lightblue;text-align:right']
						]
					]
				])->textInput()->label(false); ?>
    
    <div class="form-group text-right">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
