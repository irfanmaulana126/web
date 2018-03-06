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
	
	function tombolDetailPerStore(){
		//$title= Yii::t('app','Rincian Per-Toko');
		$title= Yii::t('app','');
		$url = Url::toRoute(['/dashboard/trafik-per-store']);
		$options1 = [
					'id'=>'detail-trafik',
					//'class'=>"btn btn-danger btn-xs",
					'title'=>'Tampilkan chart Per-Toko'
		];
		$icon1 = '<span class="fa-stack fa-md text-left">
				  <b class="fa fa-circle fa-stack-2x" style="color:#ffffff"></b>
				  <b class="fa fa fa-search-plus fa-stack-1x" style="color:#000000"></b>
				</span>
		';
		$label1 = $icon1.' '.$title ;
		$content = Html::a($label1,$url,$options1);
		return $content;		
	}
	
	function tombolViewModalDetailPerStore(){
		//$title= Yii::t('app','Rincian Per-Toko');
		$title= Yii::t('app','');
		$url = Url::toRoute(['/dashboard/default/trafik-per-toko']);
		$options1 = [
					'value'=>$url,
					'id'=>'detail-trafik-modal-button',
					'data-pjax' => 1,
					//'class'=>"btn btn-danger btn-xs",
					'title'=>'Tampilkan chart Per-Toko'
		];
		$icon1 = '<span class="fa-stack fa-md text-left">
				  <b class="fa fa-circle fa-stack-2x" style="color:#ffffff"></b>
				  <b class="fa fa fa-eye fa-stack-1x" style="color:#000000"></b>
				</span>
		';
		$label1 = $icon1.' '.$title ;
		//$content = Html::button($label1,$options1);
		$content = Html::a($label1,'#',$options1);
		return $content;		
	}
?>