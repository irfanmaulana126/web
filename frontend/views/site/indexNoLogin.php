<?php

use kartik\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;


	$bgColor='#4d4368';//'#3e3939';//black   //'#2292d0'//blue;
	$bgColorIcon='#fffefe';//'#c72b42';//merah
	$rangeColorIcon='#4d4368';//blue;'#25ca4f';// hijo
	$colorIcon='#3e3939';
	$colorTextIcon='#0f0202';
?>
<!-- Header -->   
<div class="container" >
  <div class="row" style="padding-top:80px">
    <div class="col-lg-4"></div>
    <div class="col-lg-4">
		<div class="panel panel-info" style=" background-color:rgba(140, 220, 227, 0.1);" >
		  <!--<div class="panel-heading">Panel Header</div>!-->
		  <div class="panel-body">
			  <?php
					if (Yii::$app->user->isGuest){
						$xLogin= $this->render('login',[
							'model'=>$model
						]);
						
						 // echo Html::panel(
							// [	
								// 'heading' =>false, 
								// 'body' => $xLogin,
								// 'footer'=>false
							// ],
							// Html::TYPE_PRIMARY
						// );
						
						echo $xLogin;
						
					}
				?>		
		  
		  
		  </div>
		</div>
			
	
	</div>
    <div class="col-lg-4"></div>
  </div>
</div>


	

