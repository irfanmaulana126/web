<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
// use common\widgets\Alert;
use frontend\assets\AppAsset;
AppAsset::register($this);
dmstr\web\AdminLteAsset::register($this);
$this->registerCss("
	#.main-sidebar .sidebar {
	#	position: fixed;
	#	width: 100%;
	#}	
		
	header.main-header {
		position: fixed;
		width: 100%;
	}	

");
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
?>
<?php $this->beginPage() ?>
	<!DOCTYPE html>
	<html lang="<?= Yii::$app->language ?>">
		<head>
			<meta charset="<?= Yii::$app->charset ?>">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			 <link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/favicon.ico" type="image/x-icon" />
			<?= Html::csrfMetaTags() ?>
			<title><?= Html::encode($this->title) ?></title>
			<?php $this->head() ?>
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		</head>
		<!-- 
			Default collapse ~ptr.nov~ 
			skin-blue sidebar-mini sidebar-collapse
		!-->
		<!--<body class="skin-blue sidebar-collapse" style="min-height:680px"> 	!-->	
		 <body class="hold-transition skin-blue sidebar-mini">
			<! - NOT LOGIN- Author : -ptr.nov- >
			<?php if (Yii::$app->user->isGuest) { ?>
				<?php $this->beginBody() ?>
					<div class="wrap"  style="background-color:powderblue;min-height:650px">
						<!-- NAV BAR !-->
						<?php //=$this->render('main-navbarNologin')?>
						<!-- BODY CONTAINER !-->
							<?= $content ?>
						<!-- FOOTER !-->
						<?php //=$this->render('main-footer_noLogin')?>
					</div>
					
				<?php $this->endBody() ?>
			<?php }; ?>
			<! -LOGIN- Author : -ptr.nov- >
			<?php if (!Yii::$app->user->isGuest) { ?>
				<?php $this->beginBody() ?>
					<div class="wrapper">
						<?= $this->render('adminlte/header.php',[
							'directoryAsset' => $directoryAsset
							]) 
						?>
						<?= $this->render('adminlte/left.php',[
							'directoryAsset' => $directoryAsset
							])
						?>
						<?= $this->render('adminlte/content.php',[
								'content' => $content, 'directoryAsset' => $directoryAsset
							]) 
						?>
						<!-- TOP NAV BAR !-->
						<?php //=$this->render('main-navbar')?>
						<!-- LEFT MENU 
						<aside class="main-sidebar " style="min-height:680px">	!-->					
						<?php //=$this->render('mainLeft'); ?>
						<!-- </aside>
						<!-- BODY CONTAINER !-->	
						<?php //=$this->render('mainContent',['content'=>$content]); ?>	
						<!-- FOOTER !-->
						<?php //=$this->render('main-footer')?>						
					</div>
					
				<?php $this->endBody() ?>
			<?php }; ?>
		</body>
	</html>
<?php $this->endPage() ?>
