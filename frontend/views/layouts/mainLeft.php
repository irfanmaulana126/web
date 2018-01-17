<?php
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\User;
use common\models\UserloginSearch;
use yii\web\View;
use kartik\sidenav\SideNav;
// use frontend\assets\AppAsset;
// AppAsset::register($this);
// print_r( Yii::t('app', 'stock-product'));
// print_r(Yii::$app->getUserOpt->UserMenu2());
// die();

//$base64 ='data:image/jpg;charset=utf-8;base64,'.Yii::$app->getUserOpt->user()['IMG64'];
$img = Url::to('http://image.kontrolgampang.com/user/').Yii::$app->getUserOpt->user()['ACCESS_ID'].'.jpeg';      
// $imageData = Url::to('http://image.kontrolgampang.com/user/').Yii::$app->getUserOpt->user()['ACCESS_ID'].'.jpeg';  
// $ambilStr=file_get_contents($imageData);    
//$img = base64_encode($ambilStr);

$corp=Yii::$app->getUserOpt->user()['CORP_NM']!=''?Yii::$app->getUserOpt->user()['CORP_NM']:'NAMA PERUSAHAAN';
$sideMenu=SideNav::widget([
	'headingOptions' => ['style'=>Yii::$app->getTemplate->Template(Yii::$app->user->identity->TEMPLATE)['LifeMenu-Header']],
	'containerOptions'=>['style'=>Yii::$app->getTemplate->Template(Yii::$app->user->identity->TEMPLATE)['LifeMenu-Content']],
	//'type' => SideNav::TYPE_SUCCESS,
	'encodeLabels' => false,
	'heading' => '<b>'.$corp.'</b>',
	//'indItem'=>'',
	'items' =>Yii::$app->getUserOpt->UserMenu2()
]);

?>
	<section class="sidebar " >
		<!-- User Login -->
			<div class="user-panel" >
				<div class="pull-left" style="text-align: left,font-family: tahoma ;font-size: 9pt;">
					<img src="<?=$img?>" class="img-circle" alt="Cinque Terre" width="80" height="80"/>
				</div>
				<div class="pull-left info" style="font-family: tahoma ;font-size: 9pt;margin-left: 30px;margin-top:15px" >
					<p><?=Yii::$app->getUserOpt->user()['PROFILE_NM']?></p>
				
					<a href="#"><i class="fa fa-circle text-success" style="text-align: left,font-family: tahoma ;font-size: 9pt;"> Setting</i> </a>
				</div>
			</div>
		<!--<div class="user-panel" style="margin-top:20px;background-color:rgba(19, 105, 144, 1)">
			 /.Company Select Dashboard 
			 <p style="color:white;font-family:tahoma;font-size:11pt;text-align:center">-->
				<?php //Yii::$app->getUserOpt->user()['CORP_NM']?>
			 </p>
		<!--</div>-->
		   
		<!-- /.User Login -->
		<!-- search form -->
			<!-- 
			<form action="#" method="get" class="sidebar-form skin-blue">
				<div class="input-group">
					<input type="text" name="q" class="form-control" placeholder="Search..."/>
				  <span class="input-group-btn">
					<button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
					</button>
				  </span>
				</div>
			</form>
			 -->
		<!-- /.search form -->
			<?php
				/**
				 * Author: -ptr.nov-
				 * Noted: add variable "sideMenu" get value
				 * \vendor\yiisoft\yii2\web\View.php
				*/
			/* $side_menu='';
				//echo $this->sideMenu;
				if ($this->sideMenu != false) {
					$getSideMenu=$this->sideMenu;
					if (M1000::find()->findMenu($this->sideMenu)->one()){
						$getSideMenu=$this->sideMenu;

					}else{
						echo Html::panel(
							['heading' => 'variabel $this->sideMenu = "'.  $getSideMenu . '"; Tidak ditemukan dalam database dbm000, tabel m1000, tambahkan pada view anda menu yang benar untuk menu samping '],
							Html::TYPE_INFO
						);
						 $getSideMenu='mdefault';
					}
				}else{
					$getSideMenu='mdefault';
				};

				$side_menu=\yii\helpers\Json::decode(M1000::find()->findMenu($getSideMenu)->one()->jval);
				if (!Yii::$app->user->isGuest) {
					echo SideNav::widget([
						'items' => $side_menu,
						'encodeLabels' => false,
						//'heading' => $heading,
						'type' => SideNav::TYPE_DEFAULT,
						'options' => [
							'class' => 'navbar-default bg-black',
							//'style'=>'background-color:#313131',
						],
					]);
				}; */
			?>
			
			<?php
				//echo Yii::$app->getUserOpt->UserMenu();
				echo $sideMenu;;
			?>
			
	</section>
