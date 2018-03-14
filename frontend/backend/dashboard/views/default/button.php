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
	
	
	//==TRAFIK== Detail
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
	
	//==TRAFIK== view
	function tombolViewModalDetailPerStore(){
		//$title= Yii::t('app','Rincian Per-Toko');
		$title= Yii::t('app','');
		$url = Url::toRoute(['/dashboard/default/trafik-per-toko']);
		$options1 = [
					'value'=>$url,
					'id'=>'detail-trafik-modal-button',
					'data-pjax' => 1,
					//'class'=>"btn btn-danger btn-xs",
					'title'=>'View Chart'
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
	
	//==SALES BULANAN== Detail
	function tombolDetailSalesBulananPerStore(){
		//$title= Yii::t('app','Rincian Per-Toko');
		$title= Yii::t('app','');
		$url = Url::toRoute(['/dashboard/salesmonth-detail']);
		$options1 = [
					'id'=>'detail-sales-bulanan',
					//'class'=>"btn btn-danger btn-xs",
					'title'=>'Detail Sales Bulanan'
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
	//==SALES BULANAN== view
	function tombolViewModalSalesBulananPerStore(){
		//$title= Yii::t('app','Rincian Per-Toko');
		$title= Yii::t('app','');
		$url1 = Url::toRoute(['/dashboard/default/sales-bulanan']);
		$options1 = [
					'value'=>$url1,
					'id'=>'detail-salesbulanan-modal-button',
					'data-pjax' => 1,
					//'class'=>"btn btn-danger btn-xs",
					'title'=>'View Chart'
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
	
	//==SALES MINGGUAN== Detail
	function tombolDetailSalesMingguanPerStore(){
		//$title= Yii::t('app','Rincian Per-Toko');
		$title= Yii::t('app','');
		$url = Url::toRoute(['/dashboard/salesweek-detail']);
		$options1 = [
					'id'=>'detail-sales-mingguan',
					//'class'=>"btn btn-danger btn-xs",
					'title'=>'Detail Sales Mingguan'
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
	//==SALES MINGGUAN== view
	function tombolViewModalSalesMingguanPerStore(){
		//$title= Yii::t('app','Rincian Per-Toko');
		$title= Yii::t('app','');
		$url1 = Url::toRoute(['/dashboard/default/sales-mingguan']);
		$options1 = [
					'value'=>$url1,
					'id'=>'detail-salesmingguan-modal-button',
					'data-pjax' => 1,
					//'class'=>"btn btn-danger btn-xs",
					'title'=>'View Chart'
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