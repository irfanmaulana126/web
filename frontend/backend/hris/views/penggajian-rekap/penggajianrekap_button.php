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
	function periodePersensi($date){
		return '<div style="float:left;padding:10px 20px 0px 5px"><b> PERIOD :'.$date['tanggal1'].' s/d '.$date['tanggal2'].'</b></div>';		
	}
	
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
	 *  BUTTON VIEW
	*/
	function tombolView($url, $model){
		$title1 = Yii::t('app',' View');
		$options1 = [
			'value'=>Url::to(['/hris/karyawan/view','id'=>$model['ID']]),
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
	
	/*
	 * BUTTON EDIT
	*/
	function tombolEdit($url, $model){
		$title1 = Yii::t('app',' Edit');
		$options1 = [
			'value'=>url::to(['/hris/karyawan/edit','id'=>$model['ID']]),
			'id'=>'karyawan-button-row-edit',
			'class'=>"btn btn-default btn-xs",    
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
		return '<li>'.$content.'</li>';
	}
	/*
	 * BUTTON SEARCH PERIODE
	*/
	
	function tombolSearchPeriode($store){
		$title= Yii::t('app','');
		$url = Url::toRoute(['/hris/penggajian-rekap/pencarian-index','paramCari'=>$store]);
		$options1 = ['value'=>$url,
					'id'=>'gaji-button-periode',
					'data-pjax' => false,
					'class'=>"btn btn-warning btn-xs",
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
	function tombolExportExcel($store){
		$title= Yii::t('app','Export Excel');
		$url = Url::toRoute(['/hris/penggajian-rekap/pencarian-export','store'=>$store]);
		$options1 = ['value'=>$url,
					'id'=>'export-button-periode',
					'data-pjax' => 0,
					'class'=>"btn btn-primary btn-xs",
					'title'=>'Export Excel'
		];
		$icon1 = '<span class="fa-stack fa-sm text-left">
					<b class="fa fa-circle fa-stack-2x" style="color:#ffffff"></b>
					<b class="fa fa-file-excel-o fa-stack-1x" style="color:#000000"></b>
				</span>
		';
		$label1 = $icon1.' '.$title ;
		$content = Html::button($label1,$options1);
		return $content;		
	}
	
?>