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
					'class'=>"btn btn-success btn-xs",
					'title'=>'Tambah'
		];
		$content = Html::button($title,$options1);
		return $content;		
	}
	function tombolKembali()
	{		
		$title= Yii::t('app','');
		$url = Url::toRoute(['/laporan/laporan']);
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
	 * BUTTON Akun List
	*/
	function tombolViewAkun(){
		$title= Yii::t('app','List Akun');
		$url = Url::toRoute(['/laporan/jurnal-transaksi-bulan/view-akun']);
		$options1 = ['value'=>$url,
					'id'=>'jurnal-button-akun',
					'data-pjax' => false,
					'class'=>"btn btn-success btn-xs",
					'title'=>'Tambah'
		];
		$content = Html::button($title,$options1);
		return $content;		
	}
    
?>