
<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
/* @var $this yii\web\View */
/* @var $model app\backend\master\models\ItemFdiscount */
/* @var $form yii\widgets\ActiveForm */
if(!empty($model->gambar)){
    $data=unserialize($model->gambar);
    foreach ($data as $key) {
            $datas[]='<img src="'.$key.'" alt="Your Avatar" style="width:160px;align:center">';
        }
}else{
    $datas='';
}
switch ($model->STATUS) {
    case '0':
            $stt ='<span class="fa-stack fa-xl">
            <i class="fa fa-circle-thin fa-stack-2x"  style="color:#25ca4f"></i>
            <i class="fa fa fa-refresh fa-spin fa-stack-1x" style="color:#ee0b0b"></i>
          </span> Proses';
        break;
    case '1':
            $stt ='<span class="fa-stack fa-xl">
            <i class="fa fa-circle-thin fa-stack-2x"  style="color:#25ca4f"></i>
            <i class="fa fa fa-check fa-stack-1x" style="color:#ffc107"></i>
          </span> Pendding';
        break;
    case '2':
            $stt ='<span class="fa-stack fa-xl">
            <i class="fa fa-circle-thin fa-stack-2x"  style="color:#25ca4f"></i>
            <i class="fa fa-check fa-stack-1x" style="color:#4caf50"></i>
          </span> Success';
        break;
    case '2':
            $stt ='<span class="fa-stack fa-xl">
            <i class="fa fa-circle-thin fa-stack-2x"  style="color:#25ca4f"></i>
            <i class="fa fa-close fa-stack-1x" style="color:#4caf50"></i>
          </span> Gagal';
        break;
    default:
            $stt ='-';
    break;
}

$attributes = [
    [
        'attribute'=>'NAMA_LENGKAP',
        'valueColOptions'=>['style'=>'width:40%'],
    ],
    [
        'attribute'=>'BANK',
        'valueColOptions'=>['style'=>'width:40%'],
        'value'=>$model->BANK,
    ],
    [
        'attribute'=>'NO_REK',
        'valueColOptions'=>['style'=>'width:40%'],
        'value'=>$model->NO_REK,
    ],
    [
        'attribute'=>'TLP',
        'valueColOptions'=>['style'=>'width:40%'],
        'value'=>$model->TLP,
    ],
    [
        'attribute'=>'ALAMAT',
        'valueColOptions'=>['style'=>'width:40%'],
        'value'=>$model->ALAMAT,
    ],
    [
        'attribute'=>'STATUS',
        'valueColOptions'=>['style'=>'width:40%'],
        'value'=>$stt,
        'format'=>'raw'
    ],
];
?>
<div class="item-fdiscount-form">
    <?= DetailView::widget([
        'id'=>'dv-data-barang-view',
        'model' => $model,
        'attributes' =>$attributes,
        'hover'=>true,
        'panel'=>[
			'type'=>DetailView::TYPE_INFO,
		],
        'mode'=>DetailView::MODE_VIEW,
        'buttons1'=>'',
		'buttons2'=>'{view}{save}',		
    ]) ;
    ?>
    <div style="margin:10px">
    <?php
    foreach($datas as $data){
        echo $data.'&nbsp&nbsp&nbsp';
    }
    ?>
    </div>
</div>
