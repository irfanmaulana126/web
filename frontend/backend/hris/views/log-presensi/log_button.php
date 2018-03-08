<?php
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\FileInput;
use yii\base\DynamicModel;

/**
* ===============================
 * Button & Link 
 * Author	: ptr.novgmail.com
 * Update	: 05/09/2017
 * Version	: 2.1
 * ===============================
*/
	
	function tombolKembali()
	{		
		$title= Yii::t('app','');
		$url = Url::toRoute(['/hris/rekap']);
		$options1 = [
			'id'=>'back-trafik',
			'class'=>"btn btn-xs",
			'title'=>'Kembali Menu Laporan'
		];
		$icon1 = '<span class="fa-stack fa-md text-left">
		<b class="fa fa-circle fa-stack-2x" style="color:black"></b>
		<b class="fa fa fa fa-mail-reply fa-stack-1x" style="color:white"></b>
		</span>
		';
		$label1 = $icon1.' '.$title ;
		echo $content = Html::a($label1,$url,$options1);
	}
    
?>