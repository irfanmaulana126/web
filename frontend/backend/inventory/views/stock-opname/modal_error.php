<?php
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\widgets\ActiveForm;
use kartik\widgets\FileInput;
use kartik\builder\TabularForm;
use yii\data\ArrayDataProvider;
echo Html::beginForm([	
	'enableClientValidation'=> true,
	//'enableAjaxValidation'=>true,
	//'method' => 'post',
	//'validationUrl'=>Url::toRoute('/absensi/absen-import/valid')
	'action' =>['/inventory/stock-opname/export']
]);
echo TabularForm::widget([
    // your data provider
    'dataProvider'=>$dataProvider,
 
    // formName is mandatory for non active forms
    // you can get all attributes in your controller 
    // using $_POST['kvTabForm']
    'formName'=>'kvTabForm',
    'actionColumn'=>false,
    // set defaults for rendering your attributes
    'attributeDefaults'=>[
        'type'=>TabularForm::INPUT_TEXT,
    ],
    
    // configure attributes to display
    'attributes'=>[
        'UNIX_BULAN_ID'=>['label'=>'UNIX_BULAN_ID', 'type'=>TabularForm::INPUT_HIDDEN_STATIC],
        'STORE_NM'=>['label'=>'STORE_NM', 'type'=>TabularForm::INPUT_HIDDEN_STATIC],
        'PRODUCT_NM'=>['label'=>'PRODUCT_NM', 'type'=>TabularForm::INPUT_STATIC],
        'STOCK_INPUT_ACTUAL'=>['label'=>'STOCK_INPUT_ACTUAL'],
    ],
    
    // configure other gridview settings
    'gridSettings'=>[
        'panel'=>[
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Manage Books</h3>',
            'type'=>GridView::TYPE_PRIMARY,
            'before'=>false,
            'footer'=>false,
            'after'=>Html::button('<i class="glyphicon glyphicon-plus"></i> Add New', ['type'=>'button', 'class'=>'btn btn-success kv-batch-create']) . ' ' . 
                    Html::button('<i class="glyphicon glyphicon-remove"></i> Delete', ['type'=>'button', 'class'=>'btn btn-danger kv-batch-delete']) . ' ' .
                    Html::button('<i class="glyphicon glyphicon-floppy-disk"></i> Save', ['type'=>'button', 'class'=>'btn btn-primary kv-batch-save'])
        ]
    ]
]);
echo Html::endForm();
?>