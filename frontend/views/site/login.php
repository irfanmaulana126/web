<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\label\LabelInPlace;
use kartik\password\PasswordInput;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
$config = ['template'=>"{input}\n{error}\n{hint}"];	
?>
<?php $form = ActiveForm::begin([
	'id' => 'login-form',
	'action'=>'/site/login',
	
]); ?>

				<!-- LOGIN Section -->				
<div class="row" style="align:left;">	
	<div class="col-xs-12 col-sm-12 col-lg-12" >	
		<div style="padding-top:5px;margin-left:25px;">
			<img src="http://kontrolgampang.com/logoKg.png" class="navbar-header page-scroll" style="width:100px; height:40px; margin-left:50px; margin-top:0px"/>
		</div>
		<div style="padding-top:50px;">
			<?= $form->field($model, 'username', $config)->widget(LabelInPlace::classname(),[
				 'label'=>'<i class="fa fa-user"></i> username',
				 'encodeLabel'=> false
			]);?>
			<?php //= $form->field($model, 'username')->textInput() ?>
			
			<?php echo
				$form->field($model, 'password')->widget(PasswordInput::classname(),[
				'togglePlacement' => 'left',
				'pluginOptions' => ['toggleMask' => true,'showMeter' => false],
				'options'=>['style'=>'width:230px;align:left','placeholder'=>'Password...']
				])->label('');
			?>	
			<?php //=$form->field($model, 'password', $config)->widget(LabelInPlace::classname())?>	
			<?php //= $form->field($model, 'password')->passwordInput() ?>

			<div class="form-group" style="text-align:left">
				<?= $form->field($model, 'rememberMe')->checkbox() ?>
			</div>
			<!--<div style="color:#999;margin:1em 0">
				lupa password <?php //= Html::a('reset it', ['site/request-password-reset']) ?>.
			</div>!-->
			<div class="form-group" style="text-align:right">
				<?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
			</div>
		</div>
	</div>	
</div>
<?php ActiveForm::end(); ?>
		

