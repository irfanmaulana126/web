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
	 * BUTTON SEARCH PERIODE
	*/
	function tombolCreategroupproduct(){
		$title= Yii::t('app','');
		$url = Url::toRoute(['/master/product-group/create']);
		$options1 = ['value'=>$url,
					'id'=>'create-group-product-button',
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
	 *  BUTTON VIEW GROUP
	*/
	function tombolViewgroup($url, $model){
		$title1 = Yii::t('app',' View');
		$options1 = [
			'value'=>url::to(['/master/product-group/view','ID' => $model['ID'], 'STORE_ID' => $model['STORE_ID'], 'GROUP_ID' => $model['GROUP_ID'], 'YEAR_AT' => $model['YEAR_AT'], 'MONTH_AT' => $model['MONTH_AT']]),
			'id'=>'group-product-button-row-view',
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
	 * BUTTON EDIT GROUP
	*/
	function tombolEditgroup($url, $model){
		$title1 = Yii::t('app',' Edit');
		$options1 = [
			'value'=>url::to(['/master/product-group/update','ID' => $model['ID'], 'STORE_ID' => $model['STORE_ID'], 'GROUP_ID' => $model['GROUP_ID'], 'YEAR_AT' => $model['YEAR_AT'], 'MONTH_AT' => $model['MONTH_AT']]),
			'id'=>'group-product-button-row-edit',
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
	 * BUTTON Hapus GROUP
	*/
	function tombolHapusgroup($url, $model){
		$title1 = Yii::t('app',' Hapus');
		$options1 = [
			'href'=>url::to(['/master/product-group/delete','ID' => $model['ID'], 'STORE_ID' => $model['STORE_ID'], 'GROUP_ID' => $model['GROUP_ID'], 'YEAR_AT' => $model['YEAR_AT'], 'MONTH_AT' => $model['MONTH_AT']]),
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
	
	function tombolDiscount($access,$product,$store){
		$title1 = Yii::t('app','');
		$options1 = [
			'value'=>url::to(['/master/data-barang/discount','ACCESS_GROUP'=>$access,'PRODUCT_ID'=>$product,'STORE_ID'=>$store]),
			'id'=>'databarang-button-row-discount',
			'class'=>"btn btn-success btn-xs",  
		];
		$icon1 = '
		<span class="fa-stack fa-sm text-left">
			<b class="fa fa-circle fa-stack-2x" style="color:#ffffff"></b>
			<b class="fa fa-plus fa-stack-1x" style="color:#000000"></b>
		</span>
		';      
		$label1 = $icon1 . '  ' . $title1;
		$content = Html::button($label1,$options1);		
		return $content;
	}
	
	function tombolHarga($access,$product,$store){
		$title1 = Yii::t('app','');
		$options1 = [
			'value'=>url::to(['/master/data-barang/harga','ACCESS_GROUP'=>$access,'PRODUCT_ID'=>$product,'STORE_ID'=>$store]),
			'id'=>'databarang-button-row-harga',
			'class'=>"btn btn-success btn-xs",    
		];
		$icon1 = '
		<span class="fa-stack fa-sm text-left">
			<b class="fa fa-circle fa-stack-2x" style="color:#ffffff"></b>
			<b class="fa fa-plus fa-stack-1x" style="color:#000000"></b>
		</span>
		';      
		$label1 = $icon1 . '  ' . $title1;
		$content = Html::button($label1,$options1);		
		return $content;
	}

	function tombolPromo($access,$product,$store){
		$title1 = Yii::t('app',' ');
		$options1 = [
			'value'=>url::to(['/master/data-barang/promo','ACCESS_GROUP'=>$access,'PRODUCT_ID'=>$product,'STORE_ID'=>$store]),
			'id'=>'databarang-button-row-promo',
			'class'=>"btn btn-success btn-xs",    
		];
		$icon1 = '
		<span class="fa-stack fa-sm text-left">
			<b class="fa fa-circle fa-stack-2x" style="color:#ffffff"></b>
			<b class="fa fa-plus fa-stack-1x" style="color:#000000"></b>
		</span>
		';      
		$label1 = $icon1 . '  ' . $title1;
		$content = Html::button($label1,$options1);		
		return $content;
	}
	function tombolStock($access,$product,$store){
		$title1 = Yii::t('app',' ');
		$options1 = [
			'value'=>url::to(['/master/data-barang/stock','ACCESS_GROUP'=>$access,'PRODUCT_ID'=>$product,'STORE_ID'=>$store]),
			'id'=>'databarang-button-row-stock',
			'class'=>"btn btn-success btn-xs",    
		];
		$icon1 = '
		<span class="fa-stack fa-sm text-left">
			<b class="fa fa-circle fa-stack-2x" style="color:#ffffff"></b>
			<b class="fa fa-plus fa-stack-1x" style="color:#000000"></b>
		</span>
		';      
		$label1 = $icon1 . '  ' . $title1;
		$content = Html::button($label1,$options1);		
		return $content;
	}
	

	/*
	 *  BUTTON VIEW
	*/
	function tombolViewDiscount($url, $model){
		$title1 = Yii::t('app',' View');
		$options1 = [
			'value'=>url::to(['/master/product-discount/view', 'ID' => $model['ID'], 'PRODUCT_ID' => $model['PRODUCT_ID'], 'YEAR_AT' => $model['YEAR_AT'], 'MONTH_AT' => $model['MONTH_AT']]),
			'id'=>'databarang-button-row-view-discount',
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
	function tombolEditDiscount($url, $model){
		$title1 = Yii::t('app',' Edit');
		$options1 = [
			'value'=>url::to(['/master/product-discount/update', 'ID' => $model['ID'], 'PRODUCT_ID' => $model['PRODUCT_ID'], 'YEAR_AT' => $model['YEAR_AT'], 'MONTH_AT' => $model['MONTH_AT']]),
			'id'=>'databarang-button-row-edit-discount',
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
	function tombolHapusDiscount($url, $model){
		$title1 = Yii::t('app',' Hapus');
		$options1 = [
			'href'=>url::to(['/master/product-discount/delete', 'ID' => $model['ID'], 'PRODUCT_ID' => $model['PRODUCT_ID'], 'YEAR_AT' => $model['YEAR_AT'], 'MONTH_AT' => $model['MONTH_AT']]),
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


	/*
	 *  BUTTON VIEW
	*/
	function tombolViewPromo($url, $model){
		$title1 = Yii::t('app',' View');
		$options1 = [
			'value'=>url::to(['/master/product-promo/view','ID' => $model['ID'], 'PRODUCT_ID' => $model['PRODUCT_ID'], 'YEAR_AT' => $model['YEAR_AT'], 'MONTH_AT' => $model['MONTH_AT']]),
			'id'=>'databarang-button-row-view-promo',
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
	function tombolEditPromo($url, $model){
		$title1 = Yii::t('app',' Edit');
		$options1 = [
			'value'=>url::to(['/master/product-promo/update','ID' => $model['ID'], 'PRODUCT_ID' => $model['PRODUCT_ID'], 'YEAR_AT' => $model['YEAR_AT'], 'MONTH_AT' => $model['MONTH_AT']]),
			'id'=>'databarang-button-row-edit-promo',
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
	function tombolHapusPromo($url, $model){
		$title1 = Yii::t('app',' Hapus');
		$options1 = [
			'href'=>url::to(['/master/product-promo/delete','ID' => $model['ID'], 'PRODUCT_ID' => $model['PRODUCT_ID'], 'YEAR_AT' => $model['YEAR_AT'], 'MONTH_AT' => $model['MONTH_AT']]),
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

	
	/*
	 *  BUTTON VIEW
	*/
	function tombolViewHarga($url, $model){
		$title1 = Yii::t('app',' View');
		$options1 = [
			'value'=>url::to(['/master/product-harga/view','ID' => $model['ID'], 'PRODUCT_ID' => $model['PRODUCT_ID'], 'YEAR_AT' => $model['YEAR_AT'], 'MONTH_AT' => $model['MONTH_AT']]),
			'id'=>'databarang-button-row-view-harga',
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
	function tombolEditHarga($url, $model){
		$title1 = Yii::t('app',' Edit');
		$options1 = [
			'value'=>url::to(['/master/product-harga/update','ID' => $model['ID'], 'PRODUCT_ID' => $model['PRODUCT_ID'], 'YEAR_AT' => $model['YEAR_AT'], 'MONTH_AT' => $model['MONTH_AT']]),
			'id'=>'databarang-button-row-edit-harga',
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
	 * HEADER BUTTON : Button - EXPORT EXCEL.
	*/
	function tombolExportExcel(){
		// if(getPermission()){
			// if(getPermission()->BTN_PROCESS1==1){
				$title1 = Yii::t('app', ' Export Excel');
				$url = Url::toRoute(['/master/data-barang/export']);
				$options1 = [
							'id'=>'store-button-export-excel',
							'data-pjax' => true,
							'class'=>"btn btn-primary btn-xs"  
				];
				$icon1 = '<span class="fa-stack fa-sm text-left">
							<b class="fa fa-circle fa-stack-2x" style="color:#ffffff"></b>
							<b class="fa fa-file-excel-o fa-stack-1x" style="color:#000000"></b>
						</span>';
				$label1 = $icon1 . ' ' . $title1;
				$content = Html::a($label1,$url,$options1);
				return $content;
			// }
		// }
	}
	/*
	 * BUTTON DOWNLOAD FORMAT & LIST DATA PRODUCK OPNAME
	*/
	function tombolImportExcel(){
		$title= Yii::t('app','Import Excel');
		$url = Url::toRoute(['/master/data-barang/upload-file']);
		$options1 = ['value'=>$url,
					'id'=>'databarang-button-upload',
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
	 * HEADER BUTTON : Button - EXPORT EXCEL.
	*/
	function tombolExportExceldiscount(){
		// if(getPermission()){
			// if(getPermission()->BTN_PROCESS1==1){
				$title1 = Yii::t('app', ' Export Excel');
				$url = Url::toRoute(['/master/data-barang/export-discount']);
				$options1 = [
							'id'=>'store-button-export-excel',
							'data-pjax' => true,
							'class'=>"btn btn-primary btn-xs"  
				];
				$icon1 = '<span class="fa-stack fa-sm text-left">
							<b class="fa fa-circle fa-stack-2x" style="color:#ffffff"></b>
							<b class="fa fa-file-excel-o fa-stack-1x" style="color:#000000"></b>
						</span>';
				$label1 = $icon1 . ' ' . $title1;
				$content = Html::a($label1,$url,$options1);
				return $content;
			// }
		// }
	}
	/*
	 * BUTTON DOWNLOAD FORMAT & LIST DATA PRODUCK OPNAME
	*/
	function tombolImportExceldiscount(){
		$title= Yii::t('app','Import Excel');
		$url = Url::toRoute(['/master/data-barang/upload-file-discount']);
		$options1 = ['value'=>$url,
					'id'=>'databarang-button-upload',
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
	 * HEADER BUTTON : Button - EXPORT EXCEL.
	*/
	function tombolExportExcelharga(){
		// if(getPermission()){
			// if(getPermission()->BTN_PROCESS1==1){
				$title1 = Yii::t('app', ' Export Excel');
				$url = Url::toRoute(['/master/data-barang/export-harga']);
				$options1 = [
							'id'=>'store-button-export-excel',
							'data-pjax' => true,
							'class'=>"btn btn-primary btn-xs"  
				];
				$icon1 = '<span class="fa-stack fa-sm text-left">
							<b class="fa fa-circle fa-stack-2x" style="color:#ffffff"></b>
							<b class="fa fa-file-excel-o fa-stack-1x" style="color:#000000"></b>
						</span>';
				$label1 = $icon1 . ' ' . $title1;
				$content = Html::a($label1,$url,$options1);
				return $content;
			// }
		// }
	}
	/*
	 * BUTTON DOWNLOAD FORMAT & LIST DATA PRODUCK OPNAME
	*/
	function tombolImportExcelharga(){
		$title= Yii::t('app','Import Excel');
		$url = Url::toRoute(['/master/data-barang/upload-file-harga']);
		$options1 = ['value'=>$url,
					'id'=>'databarang-button-upload',
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
	 * HEADER BUTTON : Button - EXPORT EXCEL.
	*/
	function tombolExportExcelpromo(){
		// if(getPermission()){
			// if(getPermission()->BTN_PROCESS1==1){
				$title1 = Yii::t('app', ' Export Excel');
				$url = Url::toRoute(['/master/data-barang/export-promo']);
				$options1 = [
							'id'=>'store-button-export-excel',
							'data-pjax' => true,
							'class'=>"btn btn-primary btn-xs"  
				];
				$icon1 = '<span class="fa-stack fa-sm text-left">
							<b class="fa fa-circle fa-stack-2x" style="color:#ffffff"></b>
							<b class="fa fa-file-excel-o fa-stack-1x" style="color:#000000"></b>
						</span>';
				$label1 = $icon1 . ' ' . $title1;
				$content = Html::a($label1,$url,$options1);
				return $content;
			// }
		// }
	}
	/*
	 * BUTTON DOWNLOAD FORMAT & LIST DATA PRODUCK OPNAME
	*/
	function tombolImportExcelpromo(){
		$title= Yii::t('app','Import Excel');
		$url = Url::toRoute(['/master/data-barang/upload-file-promo']);
		$options1 = ['value'=>$url,
					'id'=>'databarang-button-upload',
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
	 * HEADER BUTTON : Button - EXPORT EXCEL.
	*/
	function tombolExportExcelstock(){
		// if(getPermission()){
			// if(getPermission()->BTN_PROCESS1==1){
				$title1 = Yii::t('app', ' Export Excel');
				$url = Url::toRoute(['/master/data-barang/export-stock']);
				$options1 = [
							'id'=>'store-button-export-excel',
							'data-pjax' => true,
							'class'=>"btn btn-primary btn-xs"  
				];
				$icon1 = '<span class="fa-stack fa-sm text-left">
							<b class="fa fa-circle fa-stack-2x" style="color:#ffffff"></b>
							<b class="fa fa-file-excel-o fa-stack-1x" style="color:#000000"></b>
						</span>';
				$label1 = $icon1 . ' ' . $title1;
				$content = Html::a($label1,$url,$options1);
				return $content;
			// }
		// }
	}
	/*
	 * BUTTON DOWNLOAD FORMAT & LIST DATA PRODUCK OPNAME
	*/
	function tombolImportExcelstock(){
		$title= Yii::t('app','Import Excel');
		$url = Url::toRoute(['/master/data-barang/upload-file-stock']);
		$options1 = ['value'=>$url,
					'id'=>'databarang-button-upload',
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
    function tombolImportExcels(){
		
		$content = ButtonDropdown::widget([
			'label' => 'Import Excel',
			'options'=>[
				'class'=>"btn btn-warning",
				'title'=>'Upload Data Actual Stock',
				'style'=>'padding: 5px 5px; font-size: 12px;',
			],
			'dropdown' => [
				'items' => [
					[
						'label' => 'Cara Import',
						 'url' => 'javascript:void(0);',
						 'options'=>[
							'id'=>'cara-import',
							]
					],
					[
						'label' => 'Import File', 
						'url' => 'javascript:void(0);',
						'options'=>[
							'id'=>'databarang-button-upload',
							'value'=>Url::toRoute(['/master/data-barang/upload-file'])
							]
						],
				],
			],
		]);
		return $content;		
	}
?>