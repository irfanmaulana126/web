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
	 * BUTTON EDIT
	*/
	function tombolEditShift($url, $model){
		$title1 = Yii::t('app',' Edit');
		$options1 = [
			'value'=>url::to(['/hris/setelan-presensi/shift','STORE_ID'=>$model->STORE_ID,'ACCESS_GROUP'=>$model->ACCESS_GROUP]),
			'id'=>'presensi-button-jam',
			'class'=>"btn btn-info btn-xs",    
			'style'=>['text-align'=>'left','width'=>'100%', 'height'=>'25px','border'=> 'none'],
		];
		$icon1 = '
			<span class="fa-stack fa-xs">																	
				<i class="fa fa-circle-thin fa-stack-2x " style="color:#FF5F00"></i>
				<i class="fa fa-edit fa-stack-1x" style="color:black"></i>
			</span>
		';      
		$label1 = $icon1 . '  ' . $title1;
		$content = Html::button($label1,$options1);		
		return $content;
	}
	/*
	 * BUTTON EDIT
	*/
	function tombolEditPeriode($url, $model){
		$title1 = Yii::t('app',' Edit');
		$options1 = [
			'value'=>url::to(['/hris/setelan-presensi/periode','ID'=>$model->ID]),
			'id'=>'karyawan-button-row-edit-periode',
			'class'=>"btn btn-info btn-xs",    
			'style'=>['text-align'=>'left','width'=>'100%', 'height'=>'25px','border'=> 'none'],
		];
		$icon1 = '
			<span class="fa-stack fa-xs">																	
				<i class="fa fa-circle-thin fa-stack-2x " style="color:#FF5F00"></i>
				<i class="fa fa-edit fa-stack-1x" style="color:black"></i>
			</span>
		';      
		$label1 = $icon1 . '  ' . $title1;
		$content = Html::button($label1,$options1);		
		return $content;
	}
	/*
	 * BUTTON EDIT
	*/
	function tombolEditPotongan($url, $model){
		$title1 = Yii::t('app',' Edit');
		$options1 = [
			'value'=>url::to(['/hris/setelan-presensi/potongan','ID'=>$model->ID]),
			'id'=>'karyawan-button-row-edit-potongan',
			'class'=>"btn btn-info btn-xs",    
			'style'=>['text-align'=>'left','width'=>'100%', 'height'=>'25px','border'=> 'none'],
		];
		$icon1 = '
			<span class="fa-stack fa-xs">																	
				<i class="fa fa-circle-thin fa-stack-2x " style="color:#FF5F00"></i>
				<i class="fa fa-edit fa-stack-1x" style="color:black"></i>
			</span>
		';      
		$label1 = $icon1 . '  ' . $title1;
		$content = Html::button($label1,$options1);		
		return $content;
	}
		
?>