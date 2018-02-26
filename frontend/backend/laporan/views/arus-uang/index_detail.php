<?php

use yii\helpers\Html;
use kartik\grid\GridView;

use yii\web\View;
/* @var $this yii\web\View */
/* @var $searchModel frontend\backend\laporan\models\JurnalTemplateDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->registerJs("
// var x = document.getElementById('tahun').value;
// console.log(x);
document.getElementById('tahun').onchange = function() { 
    var x = document.getElementById('tahun').value;
    $.pjax.reload({
        url:'/laporan/arus-uang/index?id='+x, 
        container: '#arus-masuk-monthofyear',
        timeout: 1000,
    });
    
    console.log('Changed!'+x); 
}
",View::POS_READY);
?><?= GridView::widget([
		'id'=>'arus-masuk-monthofyear',
        'dataProvider' => $dataProvider,
        'summary'=>false,
        'pjax'=>true,
		'pjaxSettings'=>[
			'options'=>[
				'enablePushState'=>true,
				'id'=>'arus-masuk-monthofyear',
			],
		],
        'columns' => [
            [
                'attribute' => 'AKUN_NM',
                'label' => false,
            ],
            [
                'attribute'=>'JUMLAH',
                'label'=>false,
            ]
        ],
    ]); ?>