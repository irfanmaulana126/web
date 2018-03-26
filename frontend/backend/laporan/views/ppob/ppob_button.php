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
		$url = Url::toRoute(['/laporan']);
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
/**
* ===============================
 * Button & Link 
 * Author	: ptr.novgmail.com
 * Update	: 05/09/2017
 * Version	: 2.1
 * ===============================
*/
	
	function tombolKembaliStore()
	{		
		$title= Yii::t('app','');
		$url = Url::toRoute(['/laporan/ppob']);
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
    /*
	 * LINK EXPORT EXCEL.
	*/
	function tombolExportExcel(){
		$title1 = Yii::t('app', ' Export Excel');
		$url = Url::toRoute(['/laporan/ppob/export']);
		$options1 = [
					'value'=>$url,
					'id'=>'ppob-export-excel',
					'data-pjax' => 0,
					'class'=>"btn btn-success btn-xs",
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
    /*
	 * LINK EXPORT EXCEL.
	*/
	function tombolPerStore($tanggal){
		$title1 = Yii::t('app', 'Lihat per-Toko');
		$url = Url::toRoute(['/laporan/ppob/perstore']);
		$options1 = [
			'value'=>$url,
			'id'=>'ppob-store',
			'data-pjax' => true,
					'class'=>"btn btn-info btn-xs"  
		];
		$icon1 = '<span class="fa-stack fa-sm text-left">
		<b class="fa fa-circle fa-stack-2x" style="color:#ffffff"></b>
		<b class="fa fa-search-plus fa-stack-1x" style="color:#000000"></b>
		</span>';
		$label1 =$icon1.' '.$title1;
		$content = Html::button($label1,$options1);
		return $content;
	}	
?>