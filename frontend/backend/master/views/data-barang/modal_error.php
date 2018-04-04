<?php
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\widgets\ActiveForm;
use kartik\widgets\FileInput;
use kartik\builder\TabularForm;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use common\models\Store;
 $form = ActiveForm::begin(['action' =>['/master/data-barang/batch-update']]);
echo TabularForm::widget([
    // your data provider
    'dataProvider'=>$dataProvider,
	'form'=>$form,
    // formName is mandatory for non active forms
    // you can get all attributes in your controller 
    // using $_POST['kvTabForm']
    'formName'=>'kvTabForm',
    'actionColumn'=>false,
    // set defaults for rendering your attributes
    // 'attributeDefaults'=>[
    //     'type'=>TabularForm::INPUT_TEXT,
    // ],
    'checkboxColumn'=>false,
    // configure attributes to display
    'attributes'=>[
        'STORE_ID'=>['label'=>'STORE_ID','type'=>TabularForm::INPUT_WIDGET,
        'widgetClass'=>\kartik\select2\Select2::classname(),
        'options' => [
            'data'=>ArrayHelper::map(Store::find()->where(['ACCESS_GROUP'=>Yii::$app->user->identity->ACCESS_GROUP,'STATUS'=>['1','0']])->all(),'STORE_ID','STORE_NM'),'language' => 'en',
            'options' =>['placeholder'=>'Pilih Toko....',],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ],
         ],
        'PRODUCT_NM'=>['columnOptions'=>['width'=>'250px'],],
        'PRODUCT_QR'=>['label'=>'PRODUCT_QR'],
        'PRODUCT_HEADLINE'=>['label'=>'PRODUCT_HEADLINE'],
        'DCRP_DETIL'=>['label'=>'DCRP_DETIL'],
        'PRODUCT_WARNA'=>['label'=>'PRODUCT_WARNA','label'=>'PRODUCT_NM','type'=>TabularForm::INPUT_WIDGET, 
        'widgetClass'=>\kartik\widgets\ColorInput::classname(), 
        'options'=>[ 
            'showDefaultPalette'=>false,
            'pluginOptions'=>[
                'preferredFormat'=>'name',
                'palette'=>[
                    [
                        "white", "black", "grey", "silver", "gold", "brown", 
                    ],
                    [
                        "red", "orange", "yellow", "indigo", "maroon", "pink"
                    ],
                    [
                        "blue", "green", "violet", "cyan", "magenta", "purple", 
                    ],
                ]
            ]
        ],],
    ],
    
    // configure other gridview settings
    'gridSettings'=>[
        'panel'=>[
            'heading'=>'<h3 class="panel-title"><i class="fa fa-warning"></i> ERROR DATA</h3>',
            'type'=>GridView::TYPE_DANGER,
            'before'=>false,
            'footer'=>false,
			'after'=>'<div class="text-right">'.Html::a('<i class="	fa fa-share"></i> Kembali', ['/inventory/stock-opname'], ['class'=>'btn btn-success kv-batch-delete']).' '.Html::submitButton('<i class="glyphicon glyphicon-floppy-disk"></i> Simpan', ['type'=>'button', 'class'=>'btn btn-primary kv-batch-save']).'<div>'
        ]
    ]
]);
ActiveForm::end();
?>