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
	
	/*
	 * BUTTON SEARCH PERIODE
	*/
	function tombolSearchPeriode(){
		$title= Yii::t('app','');
		$url = Url::toRoute(['/inventory/stock-masuk/pencarian-index']);
		$options1 = ['value'=>$url,
					'id'=>'stockmasuk-button-periode',
					'data-pjax' => false,
					'class'=>"btn btn-info btn-xs",
					'title'=>'Pencarian'
		];
		$icon1 = '<span class="fa-stack fa-sm text-left">
				  <b class="fa fa-circle fa-stack-2x" style="color:#ffffff"></b>
				  <b class="fa fa-search fa-stack-1x" style="color:#000000"></b>
				</span>
		';
		$label1 = $icon1.' '.$title ;
		$content = Html::button($label1,$options1);
		return $content;		
	}
	
	/*
	 * BUTTON CARD STOCK 
	*/
	function tombolCardStock(){
		$title= Yii::t('app','');
		$url = Url::toRoute(['/inventory/stock-masuk/card-stock']);
		$options1 = [
					// 'value'=>$url,
					// 'id'=>'stockmasuk-button-card',
					'data-pjax' => 0,
					'class'=>"btn btn-success btn-xs",
					'title'=>'Card Stock Product'
		];
		$icon1 = '<span class="fa-stack fa-sm text-left">
				  <b class="fa fa-circle fa-stack-2x" style="color:#ffffff"></b>
				  <b class="fa fa-credit-card fa-stack-1x" style="color:#000000"></b>
				</span>
		';
		$label1 = $icon1.' '.$title ;
		$content = Html::a($label1,$url,$options1);
		return $content;		
	}
	/*
	 * BUTTON DOWNLOAD FORMAT & LIST DATA PRODUCK OPNAME
	*/
	function tombolUploadFormat(){
		$title= Yii::t('app','Upload Stock');
		$url = Url::toRoute(['/inventory/stock-masuk/upload-file']);
		$options1 = ['value'=>$url,
					'id'=>'stockopname-button-upload',
					'data-pjax' => false,
					'class'=>"btn btn-warning btn-xs",
					'title'=>'Upload Data Actual Stock'
		];
		$icon1 = '<span class="fa-stack fa-sm text-left">
				  <b class="fa fa-circle fa-stack-2x" style="color:#ffffff"></b>
				  <b class="fa fa-upload fa-stack-1x" style="color:#000000"></b>
				</span>
		';
		$label1 = $icon1.' '.$title ;
		$content = Html::button($label1,$options1);
		return $content;		
	}
		
	/*
	 * LINK EXPORT EXCEL.
	*/
	function tombolExportExcel(){
		$title1 = Yii::t('app', ' Export Excel');
		$url = Url::toRoute(['/inventory/stock-masuk/export']);
		$options1 = [
					'value'=>$url,
					'id'=>'stockmasuk-export-excel',
					'data-pjax' => 0,
					'class'=>"btn btn-primary btn-xs",
					'title'=>'Export Excel'
		];
		$icon1 = '<span class="fa-stack fa-sm text-left">
				  <b class="fa fa-circle fa-stack-2x" style="color:#ffffff"></b>
				  <b class="fa fa-file-excel-o fa-stack-1x" style="color:#000000"></b>
				</span>
		';
		$label1 = $icon1 . ' ' . $title1;
		$content = Html::button($label1,$options1);
		return $content;
	}		
	/**
	 * ===============================
	 * Modal store
	 * Author	: ptr.nov2gmail.com
	 * Update	: 21/01/2017
	 * Version	: 2.1
	 * ==============================
	*/
	$modalHeaderColor='#fbfbfb';//' rgba(74, 206, 231, 1)';
	
	
	
?>