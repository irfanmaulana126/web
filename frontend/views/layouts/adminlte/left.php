	<?php
use yii\helpers\Html;
use yii\helpers\Url;
$img = Url::to('https://image.kontrolgampang.com/user/').Yii::$app->getUserOpt->user()['ACCESS_ID'].'.jpeg'; 
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
       <div class="user-panel" >
				<div class="pull-left" style="text-align: left,font-family: tahoma ;font-size: 9pt;">
					<img src="<?=$img?>" class="img-circle" alt="Cinque Terre" width="60" height="60"/>
				</div>
				<div class="pull-left info" style="font-family: tahoma ;font-size: 9pt;margin-left: 30px;margin-top:15px" >
					<p><?=Yii::$app->getUserOpt->user()['PROFILE_NM']?></p>
				
					<a href="/sistem/user-profile"><i class="fa fa-circle text-success" style="text-align: left,font-family: tahoma ;font-size: 9pt;"> Setting</i> </a>
				</div>
			</div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
		<div class="user-panel" style="margin-top:20px;background-color:rgba(19, 105, 144, 1)">
			 <p style="color:white;font-family:tahoma;font-size:11pt;text-align:center">
				<?=Yii::$app->getUserOpt->user()['CORP_NM']?>
			 </p>
		</div>
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => Yii::$app->getUserOpt->UserMenu2()
            ]
        ) ?>

    </section>

</aside>
