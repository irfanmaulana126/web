<?php
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\widgets\ActiveForm;
use kartik\widgets\FileInput;
use kartik\builder\TabularForm;
use yii\data\ArrayDataProvider;
 $form = ActiveForm::begin(['action' =>['/inventory/stock-opname/batch-update']]);
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
        'UNIX_BULAN_ID'=>['label'=>'UNIX_BULAN_ID', 'type'=>TabularForm::INPUT_HIDDEN_STATIC],
        'STORE_NM'=>['label'=>'STORE_NM', 'type'=>TabularForm::INPUT_HIDDEN_STATIC],
        'PRODUCT_NM'=>['label'=>'PRODUCT_NM', 'type'=>TabularForm::INPUT_STATIC],
        'STOCK_INPUT_ACTUAL'=>['label'=>'STOCK_INPUT_ACTUAL','options'=>['type'=>'number',
		'min'=>1]],
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