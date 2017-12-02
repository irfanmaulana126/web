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
		$url = Url::toRoute(['/inventory/stock-opname/pencarian-index']);
		$options1 = ['value'=>$url,
					'id'=>'stockopname-button-periode',
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
	 * BUTTON CLOSING STOCK
	*/
	function tombolClosingStock(){
		$title= Yii::t('app','Closing Stock');
		$url = Url::toRoute(['/inventory/stock-opname/closing-stock']);
		$options1 = ['value'=>$url,
					'id'=>'stockopname-button-closing',
					'data-pjax' => false,
					'class'=>"btn btn-danger btn-xs",
					'title'=>'Closing Stok Otomatis Ahir Bulan'
		];
		$icon1 = '<span class="fa-stack fa-sm text-left">
				  <b class="fa fa-circle fa-stack-2x" style="color:#ffffff"></b>
				  <b class="fa fa-hourglass-start fa-stack-1x" style="color:#000000"></b>
				</span>
		';
		$label1 = $icon1.' '.$title ;
		$content = Html::button($label1,$options1);
		return $content;		
	}
	
	/*
	 * BUTTON DOWNLOAD FORMAT & LIST DATA PRODUCK OPNAME
	*/
	function tombolDownloadFormat(){
		$title= Yii::t('app','Download Opname');
		$url = Url::toRoute(['/inventory/stock-opname/download']);
		$options1 = ['value'=>$url,
					'id'=>'stockopname-button-download',
					'data-pjax' => false,
					'class'=>"btn btn-success btn-xs",
					'title'=>'Download Format List Product Opname'
		];
		$icon1 = '<span class="fa-stack fa-sm text-left">
				  <b class="fa fa-circle fa-stack-2x" style="color:#ffffff"></b>
				  <b class="fa fa-download fa-stack-1x" style="color:#000000"></b>
				</span>
		';
		$label1 = $icon1.' '.$title ;
		$content = Html::button($label1,$options1);
		return $content;		
	}
	
	/*
	 * BUTTON DOWNLOAD FORMAT & LIST DATA PRODUCK OPNAME
	*/
	function tombolUploadFormat(){
		$title= Yii::t('app','Upload Opname');
		$url = Url::toRoute(['/inventory/stock-opname/upload-file']);
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
	function tombolExportExcel($tanggal){
		$title1 = Yii::t('app', ' Export Excel');
		$url = Url::toRoute(['/inventory/stock-opname/export?id='.$tanggal]);
		$options1 = [
					'id'=>'stockopname-export-excel',
					'data-pjax' => true,
					'class'=>"btn btn-primary btn-xs",
					'title'=>'Export Excel'
		];
		$icon1 = '<span class="fa-stack fa-sm text-left">
				  <b class="fa fa-circle fa-stack-2x" style="color:#ffffff"></b>
				  <b class="fa fa-file-excel-o fa-stack-1x" style="color:#000000"></b>
				</span>
		';
		$label1 = $icon1 . ' ' . $title1;
		$content = Html::a($label1,$url,$options1);
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