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
	function tombolCreate(){
		$title= Yii::t('app','');
		$url = Url::toRoute(['/hris/karyawan/create']);
		$options1 = ['value'=>$url,
					'id'=>'karyawan-button',
					'data-pjax' => false,
					'class'=>"btn btn-danger btn-xs",
					'title'=>'Pencarian'
		];
		$icon1 = '<span class="fa-stack fa-sm text-left">
				  <b class="fa fa-circle fa-stack-2x" style="color:#ffffff"></b>
				  <b class="fa fa-plus fa-stack-1x" style="color:#000000"></b>
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
		$url = Url::toRoute(['/hris/karyawan/export']);
		$options1 = [
					'id'=>'stockproduct-export-excel',
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
	
	/*
	 *  BUTTON VIEW
	*/
	function tombolView($url, $model){
		$title1 = Yii::t('app',' View');
		$options1 = [
			'value'=>url::to(['/hris/list-gaji/view','id'=>$model->ID]),
			'id'=>'karyawan-button-row-view',
			'class'=>"btn btn-default btn-xs",    
			'style'=>['text-align'=>'left','width'=>'100%', 'height'=>'25px','border'=> 'none'],
		];
		$icon1 = '
			<span class="fa-stack fa-xs">																	
				<i class="fa fa-circle-thin fa-stack-2x " style="color:#FF5F00"></i>
				<i class="fa fa-eye fa-stack-1x" style="color:black"></i>
			</span>
		';      
		$label1 = $icon1 . '  ' . $title1;
		$content = Html::button($label1,$options1);		
		return '<li>'.$content.'</li>';
	}
	
	function tombolAcc($url, $model){
		$title1 = Yii::t('app',' EDIT');
		$options1 = [
			'value'=>url::to(['/hris/list-gaji/acc','ID' => $model->ID, 'STORE_ID' => $model->STORE_ID, 'KARYAWAN_ID' => $model->KARYAWAN_ID, 'YEAR_AT' => $model->YEAR_AT, 'MONTH_AT' => $model->MONTH_AT]),
			'id'=>'karyawan-button-row-view',
			'class'=>"btn btn-info btn-xs",    
		];
		
		$icon1 = '
			<span class="fa-stack fa-xs">																	
				<i class="fa fa-circle-thin fa-stack-2x " style="color:#FF5F00"></i>
				<i class="fa fa-handshake-o fa-stack-1x" style="color:black"></i>
			</span>
		';      
		$label1 = $icon1 . '  ' . $title1;
		$content = Html::button($label1,$options1);		
		return $content;
	}
	
	
	
?>