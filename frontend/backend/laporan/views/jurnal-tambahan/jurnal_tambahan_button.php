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
	 * BUTTON Akun Kategori
	*/
	function tombolViewGroup(){
		$title= Yii::t('app','Kategori Akun');
		$url = Url::toRoute(['/laporan/jurnal-transaksi-bulan/view-kategori']);
		$options1 = ['value'=>$url,
					'id'=>'jurnal-button-group',
					'data-pjax' => false,
					'class'=>"btn btn-warning btn-xs",
					'title'=>'Tambah'
		];
		$content = Html::button($title,$options1);
		return $content;		
	}
	/*
	 * BUTTON Akun List
	*/
	function tombolViewAkun(){
		$title= Yii::t('app','List Akun');
		$url = Url::toRoute(['/laporan/jurnal-transaksi-bulan/view-akun']);
		$options1 = ['value'=>$url,
					'id'=>'jurnal-button-akun',
					'data-pjax' => false,
					'class'=>"btn btn-warning btn-xs",
					'title'=>'Tambah'
		];
		$content = Html::button($title,$options1);
		return $content;		
	}
    function tombolCreate(){
		$title= Yii::t('app','');
		$url = Url::toRoute(['/laporan/jurnal-tambahan/create']);
		$options1 = ['value'=>$url,
					'id'=>'jurnal-tambah-button-create',
					'data-pjax' => false,
					'class'=>"btn btn-success btn-xs",
					'title'=>'Tambah'
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
			'value'=>url::to(['/laporan/jurnal-tambahan/view','JURNAL_ID' => $model->JURNAL_ID, 'MONTH_AT' => $model->MONTH_AT, 'YEAR_AT' => $model->YEAR_AT]),
			'id'=>'jurnal-tambah-button-view',
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
			'value'=>url::to(['/laporan/jurnal-tambahan/update','JURNAL_ID' => $model->JURNAL_ID, 'MONTH_AT' => $model->MONTH_AT, 'YEAR_AT' => $model->YEAR_AT]),
			'id'=>'jurnal-tambah-button-edit',
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
	 * BUTTON Hapus
	*/
	function tombolHapus($url, $model){
		$title1 = Yii::t('app',' Hapus');
		$options1 = [
			'href'=>url::to(['/laporan/jurnal-tambahan/delete','JURNAL_ID' => $model->JURNAL_ID, 'MONTH_AT' => $model->MONTH_AT, 'YEAR_AT' => $model->YEAR_AT]),
			'class'=>"btn btn-default btn-xs",
			'data'=>['confirm'=>'Apakah kamu yakin ingin mengapus data ini','method'=>'post',],    
			'style'=>['text-align'=>'left','width'=>'100%', 'height'=>'25px','border'=> 'none'],
		];
		$icon1 = '
			<span class="fa-stack fa-xs">																	
				<i class="fa fa-circle-thin fa-stack-2x " style="color:#FF5F00"></i>
				<i class="fa fa-trash fa-stack-1x" style="color:black"></i>
			</span>
		';      
		$label1 = $icon1 . '  ' . $title1;
		$content = Html::button($label1,$options1);		
		return '<li>'.$content.'</li>';
	}
?>