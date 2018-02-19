<?php
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;

$this->registerCss("
	/**
	 * CSS - Border radius Sudut.
	 * piter novian [ptr.nov@gmail.com].
	 * 'clientOptions' => [
	 *		'backdrop' => FALSE, //Static=disable, false=enable
	 *		'keyboard' => TRUE,	// Kyboard 
	 *	]
	*/
	.modal-content { 
		border-radius: 5px;
	}
	
");

/**
* ===============================
 * Button Permission.
 * Modul ID	: 11
 * Author	: ptr.nov2gmail.com
 * Update	: 01/02/2017
 * Version	: 2.1
 * ===============================
*/
	function getPermission(){
		if (Yii::$app->getUserOpt->Modul_akses('11')){
			return Yii::$app->getUserOpt->Modul_akses('11');
		}else{
			return false;
		}
	}
	/*
	 * Backgroun Icon Color.
	*/
	function bgIconColor(){
		//return '#f08f2e';//kuning.
		//return '#1eaac2';//biru Laut.
		return '#25ca4f';//Hijau.
	}
	
	
/**
* ===============================
 * Button & Link Modal store
 * Author	: ptr.nov2gmail.com
 * Update	: 21/01/2017
 * Version	: 2.1
 * ===============================
*/
	/**
	 * HEADER BUTTON : STORE - REGISTER STORE
	*/
	function tombolCreate(){
		$title= Yii::t('app','');
		$url = Url::toRoute(['/master/store/create']);
		$options1 = ['value'=>$url,
					'id'=>'store-button-create',
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

	function tombolReqStore(){
		$title = Yii::t('app', 'Ragister New Store');
		
		$url = Url::toRoute(['/master/store/create']);
		$options1 = ['value'=>$url,
					'id'=>'store-button-create',
					'data-pjax' => false,
					'class'=>"btn btn-success btn-xs",
					'title'=>'Tambah'
		];
		$icon1 = '<span class="fa fa-check-circle fa-lg"></span>
		';
		$label1 = $icon1.' '.$title ;
		$content = Html::button($label1,$options1);
		return $content;	
	}
	
	//HEADER BUTTON : Link Button Refresh 
	function tombolRefresh(){
		$title = Yii::t('app', 'Refresh');
		$url =  Url::toRoute(['/sistem/user-profile']);
		$options = ['id'=>'store-id-refresh',
				  'data-pjax' => 0,
				  'class'=>"btn btn-info btn-xs",
				];
		$icon = '<span class="fa fa-history fa-lg"></span>';
		$label = $icon . ' ' . $title;

		return $content = Html::a($label,$url,$options);
	}

	function tombolRestore(){
		$title = Yii::t('app', 'Restore Delete');
		$url =  Url::toRoute(['/master/store/restore']);
		$options = [
			'value'=>$url,
			'id'=>'store-button-restore',
			'data-pjax' => 0,
			'class'=>"btn btn-danger btn-xs",
			];
		$icon = '<span class="fa fa-undo fa-lg"></span>';
		$label = $icon . ' ' . $title;

		return $content = Html::button($label,$options);
	}

	
	/**
	 * HEADER BUTTON : EXPAND DETAIL
	*/
	function tombolExpadDetail($url){
		$title = Yii::t('app', 'Detail');
		$url =  Url::toRoute([$url]);
		$options = ['id'=>'store-id-expand',
				  'data-pjax' => 0,
				  'class'=>"btn btn-default btn-xs",
				];
		$icon = '<span class="fa fa-eye fa-lg"></span>';
		$label = $icon . ' ' . $title;

		return $content = Html::a($label,$url,$options);
	}
	
	/*
	 * HEADER BUTTON : Button - EXPORT EXCEL.
	*/
	function tombolExportExcel(){
		// if(getPermission()){
			// if(getPermission()->BTN_PROCESS1==1){
				$title1 = Yii::t('app', ' Export Excel');
				$url = Url::toRoute(['/efenbi-rasasayang/store/export']);
				$options1 = [
							'id'=>'store-button-export-excel',
							'data-pjax' => true,
							'class'=>"btn btn-info btn-xs"  
				];
				$icon1 = '<span class="fa fa-file-excel-o fa-lg"></span>';
				$label1 = $icon1 . ' ' . $title1;
				$content = Html::a($label1,$url,$options1);
				return $content;
			// }
		// }
	}	
		
	/*
	 *  ROWS BUTTON : Store - VIEW.
	*/
	function tombolDelete($url, $model){
				$title1 = Yii::t('app',' Hapus');
				$options1 = [
					'href'=>url::to(['/master/store/delete','id'=>$model['ID']]),
					'class'=>"btn btn-default btn-xs",
					'data'=>['confirm'=>'Apakah kamu yakin ingin mengapus data ini','method'=>'post',],    
					'style'=>['text-align'=>'left','width'=>'100%', 'height'=>'25px','border'=> 'none'],
				];
				$icon1 = '
					<span class="fa-stack fa-xs">																	
						<i class="fa fa-circle-thin fa-stack-2x " style="color:'.bgIconColor().'"></i>
						<i class="fa fa-trash fa-stack-1x" style="color:black"></i>
					</span>
				';      
				$label1 = $icon1 . '  ' . $title1;
				$content = Html::button($label1,$options1);		
				return '<li>'.$content.'</li>';
			// }
		// }
	}
	/*
	 *  ACTION BUTTON : PRODUCT LIST.
	*/
	function tombolProduct($url, $model){
		// if(getPermission()){
			//Jika BTN_CREATE Show maka BTN_CVIEW Show.
			// if(getPermission()->BTN_VIEW==1 OR getPermission()->BTN_CREATE==1){
				$title1 = Yii::t('app',' Product List');
				$url = url::to(['/master/product','storeid'=>$model->STORE_ID]);
				$options1 = [
					//'value'=>url::to(['/master/item','outlet_code'=>$model->OUTLET_CODE]),
					'id'=>'store-button-product',
					'class'=>"btn btn-default btn-xs",    
					'style'=>['text-align'=>'left','width'=>'100%', 'height'=>'28px','border'=> 'none'],
				];
				$icon1 = '
					<span class="fa-stack fa-xs">																	
						<i class="fa fa-circle-thin fa-stack-2x " style="color:'.bgIconColor().'"></i>
						<i class="fa fa-edit fa-stack-1x" style="color:black"></i>
					</span>
				';      
				$label1 = $icon1 . '  ' . $title1;
				$content = Html::a($label1,$url,$options1);		
				return $content;
			// }
		// }
	}
	
	/*
	 *  ROWS BUTTON : Store - REVIEW.
	*/
	function tombolReview($url, $model){
		// if(getPermission()){
			//Jika REVIEW Show maka Bisa Update/Editing.
			// if(getPermission()->BTN_REVIEW==1){
				$title1 = Yii::t('app',' Review');
				$options1 = [
					'value'=>url::to(['/master/outlet/review','id'=>$model->ID]),
					'id'=>'store-button-review',
					'class'=>"btn btn-default btn-xs",      
					'style'=>['text-align'=>'left','width'=>'100%', 'height'=>'25px','border'=> 'none'],
				];
				//thin -> untuk bulet luar
				$icon1 = '
					<span class="fa-stack fa-xs">																	
						<i class="fa fa-circle-thin fa-stack-2x " style="color:'.bgIconColor().'"></i>
						<i class="fa fa-edit fa-stack-1x" style="color:black"></i>
					</span>
				';      
				$label1 = $icon1 . '  ' . $title1;
				$content = Html::button($label1,$options1);		
				return '<li>'.$content.'</li>';
			// }
		// }
	}
	
	/**
	 * ROWS BUTTON : STORE - PAYMENT (per-Store).
	*/
	function tombolPayment($model){
		$title = Yii::t('app', 'Payment');
		$url =  Url::toRoute(['/payment/status','STORE_ID'=>$model->STORE_ID]);
		$options = ['id'=>'store-id-payment',
				  'data-pjax' => 0,
				  'class'=>"btn btn-default btn-xs",    
				  'style'=>['text-align'=>'left','width'=>'100%', 'height'=>'25px','border'=> 'none','color'=>'black'],
				];
		$icon = '
					<span class="fa-stack fa-xs">																	
						<i class="fa fa-circle-thin fa-stack-2x " style="color:'.bgIconColor().'"></i>
						<i class="fa fa-money fa-stack-1x" style="color:black"></i>
					</span>
				';   
		$label = $icon . ' ' . $title;
		$content = Html::a($label,$url,$options);
		return  $content ;
	}
	
	/**
	 * allow
	*/
	function tombolAllow($model){
		$title = Yii::t('app', 'Allow');
		$url =  Url::toRoute(['/payment/status','STORE_ID'=>$model->STORE_ID]);
		$options = ['id'=>'store-id-payment',
				  'data-pjax' => 0,
				  'class'=>"btn btn-default btn-xs",    
				  'style'=>['text-align'=>'left','width'=>'100%', 'height'=>'25px','border'=> 'none','color'=>'black'],
				];
		$icon = '
					<span class="fa-stack fa-xs">																	
						<i class="fa fa-circle-thin fa-stack-2x " style="color:'.bgIconColor().'"></i>
						<i class="fa fa-money fa-stack-1x" style="color:black"></i>
					</span>
				';   
		$label = $icon . ' ' . $title;
		$content = Html::a($label,$url,$options);
		return  $content ;
	}
	
	/*
	 * BUTTON EDIT
	*/
	function tombolUpdate($url, $model){
		$title1 = Yii::t('app',' Edit');
		$options1 = [
			'value'=>url::to(['/master/store/update','id'=>$model['ID']]),
			'id'=>'databarang-button-row-edit',
			'class'=>"btn btn-default btn-xs",    
			'style'=>['text-align'=>'left','width'=>'100%', 'height'=>'25px','border'=> 'none'],
		];
		$icon1 = '
			<span class="fa-stack fa-xs">																	
				<i class="fa fa-circle-thin fa-stack-2x " style="color:'.bgIconColor().'"></i>
				<i class="fa fa-edit fa-stack-1x" style="color:black"></i>
			</span>
		';      
		$label1 = $icon1 . '  ' . $title1;
		$content = Html::button($label1,$options1);		
		return '<li>'.$content.'</li>';
	}
		
	/*
	 * Button - DENY.
	 * Limited Access.
	 * update : 24/02/2017.
	 * PR	  : useroption invalid foreach.
	*/	
	function tombolDeny($url, $model){
		//if(Yii::$app->getUserOpt->Modul_aksesDeny('11')==0){
			$title1 = Yii::t('app',' Limited Access');
			$url = url::to(['/efenbi-rasasayang/store']);
			$options1 = [
				'value'=>$url,
				'id'=>'store-button-deny',
				'class'=>"btn btn-default btn-xs",      
				'style'=>['text-align'=>'left','width'=>'100%', 'height'=>'25px','border'=> 'none'],
			];
			$icon1 = '
				<span class="fa-stack fa-xs">																	
					<i class="fa fa-circle fa-stack-2x " style="color:#B81111"></i>
					<i class="fa fa-remove fa-stack-1x" style="color:#fbfbfb"></i>
				</span>
			';      
			$label1 = $icon1 . '  ' . $title1;
			$content = Html::button($label1,$options1);		
			return $content;
		//}
	}
		
	/*
	 * BUTTON CREATE PRODUK
	*/
	function tombolCreateProduk(){
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
	function tombolViewProduk($url, $model){
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
	function tombolEditProduk($url, $model){
		$title1 = Yii::t('app',' Edit');
		$options1 = [
			'value'=>url::to(['/master/store/updateproduk','id'=>$model['ID']]),
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
	function tombolHapusProduk($url, $model){
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
			'value'=>url::to(['/master/store/discount','ACCESS_GROUP'=>$model['ACCESS_GROUP'],'PRODUCT_ID'=>$model['PRODUCT_ID'],'STORE_ID'=>$model['STORE_ID']]),
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
		$title1 = Yii::t('app','Harga');
		$options1 = [
			'value'=>url::to(['/master/store/harga','ACCESS_GROUP'=>$model['ACCESS_GROUP'],'PRODUCT_ID'=>$model['PRODUCT_ID'],'STORE_ID'=>$model['STORE_ID']]),
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
			'value'=>url::to(['/master/store/promo','ACCESS_GROUP'=>$model['ACCESS_GROUP'],'PRODUCT_ID'=>$model['PRODUCT_ID'],'STORE_ID'=>$model['STORE_ID']]),
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
	function tombolStock($url, $model){
		$title1 = Yii::t('app',' Stock');
		$options1 = [
			'value'=>url::to(['/master/store/stock','ACCESS_GROUP'=>$model['ACCESS_GROUP'],'PRODUCT_ID'=>$model['PRODUCT_ID'],'STORE_ID'=>$model['STORE_ID']]),
			'id'=>'databarang-button-row-stock',
			'class'=>"btn btn-default btn-xs",    
			'style'=>['text-align'=>'left','width'=>'100%', 'height'=>'25px','border'=> 'none'],
		];
		$icon1 = '
			<span class="fa-stack fa-xs">																	
				<i class="fa fa-circle-thin fa-stack-2x " style="color:#FF5F00"></i>
				<i class="fa fa-tags fa-stack-1x" style="color:black"></i>
			</span>
		';      
		$label1 = $icon1 . '  ' . $title1;
		$content = Html::button($label1,$options1);		
		return '<li>'.$content.'</li>';
	}
	function tombolChange($model){
		$title1 = Yii::t('app',' Chnage Password');
		$options1 = [
			'value'=>url::to(['/sistem/user-profile/change', 'ACCESS_ID' => $model['ACCESS_ID']]),
			'id'=>'userprofile-button-row-change',
			'class'=>"btn btn-warning btn-xs",    
		];
		$icon1 = '<span class="fa fa-key fa-lg"></span>';      
		$label1 = $icon1 . '  ' . $title1;
		$content = Html::button($label1,$options1);		
		return $content;
	}

	function tombolEditProfile($model){
		$title1 = Yii::t('app',' Edit Profile');
		$options1 = [
			'value'=>url::to(['/sistem/user-profile/update','ACCESS_ID' => $model['ACCESS_ID']]),
			'id'=>'userprofile-button-row-profil',
			'class'=>"btn btn-success btn-xs",    
		];
		$icon1 = '<span class="fa fa-edit fa-lg"></span>';      
		$label1 = $icon1 . '  ' . $title1;
		$content = Html::button($label1,$options1);		
		return $content;
	}
	function tombolTopup($model){
		$title1 = Yii::t('app',' Cara Isi Dompet');
		$options1 = [
			'value'=>url::to(['/sistem/user-profile/dompet']),
			'id'=>'userprofile-button-row-dompet',
			'class'=>"btn btn-success btn-md",    
		];
		$icon1 = '<span class="fa fa-map fa-lg"></span>';      
		$label1 = $icon1 . '  ' . $title1;
		$content = Html::button($label1,$options1);		
		return $content;
	}
	function tombolHistoriDompet($model){
		$title1 = Yii::t('app',' Histori Dompet');
		$options1 = [
			'value'=>url::to(['/sistem/user-profile/histori-dompet','ACCESS_GROUP' => $model['ACCESS_ID'],'TGL'=>date('Y-m')]),
			'id'=>'userprofile-button-row-histori',
			'class'=>"btn btn-success btn-md",    
		];
		$icon1 = '<span class="fa fa-calendar-check-o fa-lg"></span>';      
		$label1 = $icon1 . '  ' . $title1;
		$content = Html::button($label1,$options1);		
		return $content;
	}
	
	
?>