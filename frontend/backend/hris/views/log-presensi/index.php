<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
echo $this->render('log_button');
$this->title="Setelan Presensi";
$this->params['breadcrumbs'][] = ['label'=>'Ringakasan HRD', 'url'=>'/hris'];
$this->params['breadcrumbs'][] = $this->title;
$vewBreadcrumb=Breadcrumbs::widget([
    'homeLink' => [
        'label' => Html::encode(Yii::t('yii', 'Home')),
        'url' => Yii::$app->homeUrl,
    ],
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);
?>
<div class="container-fluid">
<?=$vewBreadcrumb?>
<div style="margin-top: -10px;margin-bottom: 10px;">
		<?php//tombolKembali()?>
	</div>
<div style="font-family: verdana, arial, sans-serif ;font-size: 8pt">
		<?php//tombolKembali()?>
	</div>
</div>