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


$fbButton= yii\authclient\widgets\AuthChoice::widget([
     'baseAuthUrl' => ['site/auth'],
	 'popupMode' => true
]);
?>




<?php
$form = ActiveForm::begin([
	'id' => 'login-form',
	'action'=>'/site/login',
	
]); ?>

				<!-- LOGIN Section -->				
<div class="col-xs-12 col-sm-12 col-lg-12" >		
		<div style="padding-top:50px;margin-bottom:40px">
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
				<?php //= $form->field($model, 'rememberMe')->checkbox() ?>
			</div>
			<!--<div style="color:#999;margin:1em 0">
				lupa password <?php //= Html::a('reset it', ['site/request-password-reset']) ?>.
			</div>!-->
		</div>
			<div class="form-group" style="text-align:right">
				
					<div style="float:right; width:50px">
						<?php echo Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
					</div>
					<div style="float:right; width:80px">
						<?php echo $fbButton; ?>
					</div>
				
				</div>
			</div>
			</div>
		

<?php ActiveForm::end(); ?>


		

