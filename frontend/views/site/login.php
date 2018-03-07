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
use yii\helpers\Url;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;


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

$this->registerCss("
	.auth-icon facebook {
		margin:0 auto;
		width: 100%;
		padding-left:30%;
		text-align: center;
	}
");
	
?>
<?php
$form = ActiveForm::begin([
	//'id' => 'login-form',
	'action'=>'/site/login',
	
]); 

?>
<div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12" >
		<div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12" style="text-align:center;margin-bottom:20px;" >	
			<script type="text/javascript"> //<![CDATA[ 
				var tlJsHost = ((window.location.protocol == "https:") ? "https://secure.comodo.com/" : "http://www.trustlogo.com/");
				document.write(unescape("%3Cscript src='" + tlJsHost + "trustlogo/javascript/trustlogo.js' type='text/javascript'%3E%3C/script%3E"));
			//]]>
			</script>
			<!--<div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12" style="text-align:center;margin-bottom:20px;" >		
					<img src="<?php //echo Yii::$app->request->baseUrl; ?>/logo-kg2.png"  style="width:180px; height:80px;"/>
			</div>!-->
			<script language="JavaScript" type="text/javascript">
				TrustLogo("https://dashboard.kontrolgampang.com/logo-dashboard3.png", "CL1", "none");
			</script>
			
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
		
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
			<div class="row">		
				<?php echo Html::submitButton('Login', ['class' => 'btn btn-primary',  'style'=>'width:100%','name' => 'login-button']); ?>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding-top:2px;text-align:center'">	
			<div class="row">		
				<?php 										
					/* $title1 = Yii::t('app',' f');
					$url = Url::toRoute(['/site/auth?authclient=facebook']);
					$options1 = [
						'id'=>'facebook-id',
						'class'=>"btn btn-primary btn-xs",    
						// 'class'=>"auth-icon facebook",    
						'style'=>[
							'text-align'=>'center','width'=>'100%','font-size'=>'19px','font-weight'=>'bold',
							'height'=>'35px',
							'padding-left:0px',
							'border'=> 'none'
						],
					];					
					$content = Html::a($title1,$url,$options1);							
					echo $content;
					//Html::submitButton('facebook', ['class' => 'btn btn-primmary',  'style'=>'width:100%','name' => 'login-button']) 	 */
	

					$fbButton= yii\authclient\widgets\AuthChoice::widget([
					'id'=>'asdas',
						 'baseAuthUrl' => ['site/auth'],
						 'popupMode' => true,
						 'options'=>[
							///'class'=>'btn btn-primary btn-xs pull-center',
							//'class'=>'btn btn-primary btn-xs',
							'style'=>'width:100%;height:35px;text-align:center;padding-left:30%'
							//'style'=>'padding-left:30%'
						 ]
					]);
					echo $fbButton;
				?>					
			</div>	
		</div>	
		
		<!--<div class="form-group" style="text-align:right">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 " >	
				<div class="row">
					<div style="float:right; width:50px">
						<?php //echo Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
					</div>
					<div style="float:right; width:80px">
						<?php //echo $fbButton; ?>
					</div>				
				</div>
			</div>
		</div>	!-->
</div>


			
		

<?php ActiveForm::end(); ?>


		

