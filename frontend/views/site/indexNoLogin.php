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
<div class="col-xs-12 col-sm-12 col-lg-12" style="background-color:powderblue;padding-top:150px">	
	<div align="center">
		<div style="align:left;width:300px;">
			<?php
				if (Yii::$app->user->isGuest){
					$xLogin= $this->render('login',[
						'model'=>$model
					]);
					 echo Html::panel(
						[	
							'heading' =>false, 
							'body' => $xLogin,
							'footer'=>false
						],
						Html::TYPE_PRIMARY
					);
				}
			?>		
		</div>
	</div>
</div>
	
	

