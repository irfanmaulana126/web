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
		$url = Url::toRoute(['/master/data-barang/create']);
		$options1 = ['value'=>$url,
					'id'=>'databarang-button',
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
			'value'=>url::to(['/master/data-barang/view','id'=>$model['ID']]),
			'id'=>'databarang-button-row-view',
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
			'value'=>url::to(['/master/data-barang/update','id'=>$model['ID']]),
			'id'=>'databarang-button-row-edit',
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
			'href'=>url::to(['/master/data-barang/delete','id'=>$model['ID']]),
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
	
	function tombolDiscount($url, $model){
		$title1 = Yii::t('app',' Discount');
		$options1 = [
			'value'=>url::to(['/master/data-barang/discount','ACCESS_GROUP'=>$model['ACCESS_GROUP'],'PRODUCT_ID'=>$model['PRODUCT_ID'],'STORE_ID'=>$model['STORE_ID']]),
			'id'=>'databarang-button-row-discount',
			'class'=>"btn btn-default btn-xs",    
			'style'=>['text-align'=>'left','width'=>'100%', 'height'=>'25px','border'=> 'none'],
		];
		$icon1 = '
			<span class="fa-stack fa-xs">																	
				<i class="fa fa-circle-thin fa-stack-2x " style="color:#FF5F00"></i>
				<i class="fa fa-cubes fa-stack-1x" style="color:black"></i>
			</span>
		';      
		$label1 = $icon1 . '  ' . $title1;
		$content = Html::button($label1,$options1);		
		return '<li>'.$content.'</li>';
	}
	
	function tombolHarga($url, $model){
		$title1 = Yii::t('app',' Update Harga');
		$options1 = [
			'value'=>url::to(['/master/data-barang/harga','ACCESS_GROUP'=>$model['ACCESS_GROUP'],'PRODUCT_ID'=>$model['PRODUCT_ID'],'STORE_ID'=>$model['STORE_ID']]),
			'id'=>'databarang-button-row-harga',
			'class'=>"btn btn-default btn-xs",    
			'style'=>['text-align'=>'left','width'=>'100%', 'height'=>'25px','border'=> 'none'],
		];
		$icon1 = '
			<span class="fa-stack fa-xs">																	
				<i class="fa fa-circle-thin fa-stack-2x " style="color:#FF5F00"></i>
				<i class="fa fa-money fa-stack-1x" style="color:black"></i>
			</span>
		';      
		$label1 = $icon1 . '  ' . $title1;
		$content = Html::button($label1,$options1);		
		return '<li>'.$content.'</li>';
	}

	function tombolPromo($url, $model){
		$title1 = Yii::t('app',' Promo');
		$options1 = [
			'value'=>url::to(['/master/data-barang/promo','ACCESS_GROUP'=>$model['ACCESS_GROUP'],'PRODUCT_ID'=>$model['PRODUCT_ID'],'STORE_ID'=>$model['STORE_ID']]),
			'id'=>'databarang-button-row-promo',
			'class'=>"btn btn-default btn-xs",    
			'style'=>['text-align'=>'left','width'=>'100%', 'height'=>'25px','border'=> 'none'],
		];
		$icon1 = '
			<span class="fa-stack fa-xs">																	
				<i class="fa fa-circle-thin fa-stack-2x " style="color:#FF5F00"></i>
				<i class="fa fa-gift fa-stack-1x" style="color:black"></i>
			</span>
		';      
		$label1 = $icon1 . '  ' . $title1;
		$content = Html::button($label1,$options1);		
		return '<li>'.$content.'</li>';
	}
	
?>