<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
//use yii\bootstrap\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\label\LabelInPlace;
use kartik\password\PasswordInput;
use yii\web\View;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;

$fbButton= yii\authclient\widgets\AuthChoice::widget([
     'baseAuthUrl' => ['site/auth'],
	 'popupMode' => true
]);

$this->registerJs("
      $(document).ready(function() 
      {
         $('#showhide').click(function() 
         {
            if ($(this).data('val') == '1') 
            {
               $('#pwd').prop('type','text');
               $('#eye').attr('class','glyphicon glyphicon-eye-close');
               $(this).data('val','0');
            }
            else
            {
               $('#pwd').prop('type', 'password');
               $('#eye').attr('class','glyphicon glyphicon-eye-open');
               $(this).data('val','1');
            }
         });
      });
      
$(document).ready(function()

      {
         $('#remove').click(function()
         {
           $('#uname').val('');
         });
         
      });
 
",View::POS_READY);
	
?>
<?php
$form = ActiveForm::begin([
	//'id' => 'login-form',
	'action'=>'/site/login',
	
]); 

?>
<div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12" >
		<div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12" style="text-align:center;margin-bottom:20px;" >		
				<img src="https://dashboard.kontrolgampang.com/logo-kg2.png"  style="width:180px; height:80px;"/>
		</div>

		<div class="row">
			 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="form-group">
					<?php
						echo $form->field($model, 'username', [
							'addon' => [
								'prepend' => ['content'=>'<span class="glyphicon glyphicon-user"></span>'],
								'append' => [
									'content' => Html::button('<span class="glyphicon glyphicon-remove"></span>', ['id'=>'remove','data-val'=>'1','class'=>'btn btn-danger']), 
									'asButton' => true
								],							
							]
						])->textInput(['id'=>"uname",'placeholder'=>'Username'])->label(false);
					
					?>
				</div>
			</div>
		</div>		

		<div class="row">
			 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="form-group">
					<?php
						echo $form->field($model, 'password', [
							'addon' => [
								'prepend' => ['content'=>'<span class="glyphicon glyphicon-lock"></span>'],
								'append' => [
									'content' => Html::button('<span id="eye" class="glyphicon glyphicon-eye-open"></span>', ['id'=>'showhide','data-val'=>'1','class'=>'btn btn-warning']), 
									'asButton' => true
								],
							
							]
						])->passwordInput(['id'=>"pwd",'placeholder'=>'Password'])->label(false);
					
					?>
				</div>
				
				
			</div>
		</div>
		
		<div class="form-group" style="text-align:right">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 " >	
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


		

