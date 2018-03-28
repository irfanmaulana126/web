<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use kartik\widgets\ActiveForm;
use frontend\assets\AppAssetBackendBorder;
use yii\helpers\Url;
AppAssetBackendBorder::register($this);

$this->title = 'User Profiles';
$headerColor='rgba(128, 179, 178, 1)';
    
//print_r($userProvinsi);
$this->registerCss("
	.grdiasicolors {    
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
		box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12)!important;
        height: 140px;
        width: 142px;
	}
	.custom-file-input::-webkit-file-upload-button {
		visibility: hidden;
	}
	.custom-file-input::before {
		content: 'Pilih Foto';
		display: inline-block;
		background: #d2d6de;
		border-radius: 3px;
		padding: 5px 8px;
		outline: none;
		white-space: nowrap;
		-webkit-user-select: none;
		cursor: pointer;
		text-shadow: 1px 1px #666;
		font-weight: 700;
		font-size: 10pt;
	}
	.custom-file-input:hover::before {
		border-color: black;
	}
	.custom-file-input:active::before {
		background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9);
	}
	.w3-example {    
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
		width: 170px;
		height: 220px;    
		margin-left: 15px;
		margin-bottom: 15px;
		border-radius: 5px;
		box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12)!important;
	}
	.w3-example-box {    
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
		// width: 400px;
		// height: 30px;
		border-radius: 5px;
		text-align: center;
		padding-top: 5px;
		box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12)!important;
	}
	input[type='file']{
		color: transparent;
	}
	.image {
	opacity: 1;
	display: block;
	width: 100%;
	height: auto;
	transition: .5s ease;
	backface-visibility: hidden;
	}
	.tombol {
		padding-top:15px;
		margin-left:40px;
	}
	:link {
		color: #fdfdfd;
	}
");
/* @var $this yii\web\View */
/* @var $model frontend\backend\ppob\models\PpobTransaksi */

?>
<div class="ppob-transaksi-view">
<div class="row" style="margin-left:1px">
<div class="w3-card-2 w3-round grdiasicolors w3-left col-md-2 col-md-2">
		<div class="penampung">
            <?php if(empty($image->CORP_64)){?>
                <img src="https://www.mautic.org/media/images/default_avatar.png" alt="Your Avatar" class="image img-circle" style="width:135px;height:135px;margin-left:-12px;margin-top: 2px;">
            <?php }else{?>
                <img src="<?php echo $image->CORP_64;?>" alt="Your Avatar" class="image img-circle" style="width:135px;height:135px;margin-left:-12px;margin-top: 2px;">
            <?php }?>
        </div>
	</div>
    <div class="col-md-10 col-md-10">
    <?= DetailView::widget([
        'model' => $model,
        'panel' => [
            'type' => DetailView::TYPE_INFO,
        ],            
        'mode'=>DetailView::MODE_VIEW,
        'buttons1'=>'',
		'buttons2'=>'{view}{save}',	
        'attributes' => [
            [
                'columns' => [
                    [
                        'attribute'=>'ACCESS_ID', 
                        'label'=>'ACCESS ID',
                        'displayOnly'=>true,
                        'valueColOptions'=>['style'=>'width:30%']
                    ],
                    [
                        'attribute'=>'CORP_NM', 
                        'label'=>'COMPANY',
                        'format'=>'raw', 
                        'valueColOptions'=>['style'=>'width:30%'], 
                        'displayOnly'=>true
                    ],
                ],
            ],
            [
                'columns' => [
                    [
                        'attribute'=>'MAP_LAG', 
                        'label'=>'LANGITUDE',
                        'displayOnly'=>true,
                        'valueColOptions'=>['style'=>'width:30%']
                    ],
                    [
                        'attribute'=>'MAP_LAT', 
                        'label'=>'LANGITUDE',
                        'format'=>'raw', 
                        'valueColOptions'=>['style'=>'width:30%'], 
                        'displayOnly'=>true
                    ],
                ],
            ],
            [
                'columns' => [
                    [
                        'attribute'=>'ALAMAT', 
                        'label'=>'ALAMAT',
                        'displayOnly'=>true,
                        'valueColOptions'=>['style'=>'width:90%']
                    ],
                ],
            ],
        ],
    ]) ?>
</div>
</div>
<div class="form-group text-right">
    <?=Html::Button('Edit',['class' => 'btn btn-primary','value'=>Url::toRoute(['/sistem/corp/update?id='.$model['ID'].'']),'id'=>'edit']); ?>
    </div>
</div>
