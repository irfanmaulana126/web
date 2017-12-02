<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
     /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        // Author: -ptr.nov- : Permission Allow No Login |index|error|login 
                        'actions' => ['index', 'error','login','validasi','auth','signup'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
			'auth' => [
			  'class' => 'yii\authclient\AuthAction',
			  'successCallback' => [$this, 'oAuthSuccess'],
			],
        ];
    }

	public function oAuthSuccess($client) {
  // get user data from client
  //$userAttributes = $client->getUserAttributes();
	// if (!$this->action instanceof \yii\authclient\AuthAction) {
      // throw new \yii\base\InvalidCallException("successCallback is only meant to be executed by AuthAction!");
    // }

    $attributes = $client->getUserAttributes();
	//return $this->action->redirect( Url::toRoute(['dashboard'],true) );
	// print_r($attributes);
	// die();
	$user = \common\models\User::find()
        ->where([
            'ID_FB'=>$attributes['id'],
        ])
        ->one();
    if(!empty($user)){
        Yii::$app->user->login($user);
    }
    else{
        //Simpen disession attribute user dari Google
        $session = Yii::$app->session;
        $session['attributes']=$attributes;
        // redirect ke form signup, dengan mengset nilai variabell global successUrl
        $this->successUrl = \yii\helpers\Url::to(['signup']);
    }   
	
   /*  $externalUser = new AuthForm();
    $externalUser->authProvider = $client->getName();
    $externalUser->externalUserId = array_key_exists('id', $attributes) ? $attributes['id'] : null;
    
    if ($externalUser->validate())
    {
      if ($externalUser->isRegistered())
      {
        $externalUser->login();
        return $this->action->redirect( Url::toRoute(['private/index'],true) );
      }
      else
      {
        Yii::$app->session->set( 'signup/authProvider', $externalUser->authProvider );
        Yii::$app->session->set( 'signup/attributes'  , $attributes );
        
        return $this->action->redirect( Url::toRoute(['site/signup'],true) );
      }    
    } */
  // do some thing with user data. for example with $userAttributes['email']
}


    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
		/* Yii::$app->mailer->compose()
		 ->setFrom('postman@lukison.com')
		 ->setTo('piter@lukison.com')
		 ->setSubject('Minggu - Email sent from Yii2-Swiftmailer')
		 ->send(); */
		 
		if (\Yii::$app->user->isGuest) {
            $model = new LoginForm();
            return $this->render('indexNoLogin', [
                'model' => $model,
            ]);
        } else {
			//return $this->render('index');
			$this->redirect(array('/dashboard'));
		}
		
		
    }

	/* public function beforeAction($action)
	{		
		if ( !Yii::$app->user->isGuest)  {
			if (Yii::$app->session['userSessionTimeout'] < time()) {
				Yii::$app->user->logout();
				return $this->goHome(); 
			} else {
				Yii::$app->session->set('userSessionTimeout', time() + Yii::$app->params['sessionTimeoutSeconds']);				
				return true; // benar maka login
			}
		} else {
			return true;
		}
	} 
	 */
    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
		Yii::$app->session->set('userSessionTimeout', time() + Yii::$app->params['sessionTimeoutSeconds']);
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            //return $this->render('login', [
            //    'model' => $model,
           // ]);
            // $js='$("#modal_login").modal("show")';
            // $this->getView()->registerJs($js);
            // return $this->render('login',['model' => $model]);
			$model = new LoginForm();
            return $this->render('indexNoLogin', [
                'model' => $model,
            ]);
        }
    }

	protected  function afterLogin(){
		//Yii::$app->session->set('userSessionTimeout', time() + Yii::$app->params['sessionTimeoutSeconds']);
		
	} 
	
	public function actionAlert(){
        if (\Yii::$app->user->isGuest) {
            return $this->goHome();
        } else {
			if (Yii::$app->session['userSessionTimeout']< time() ) {
				// timeout
				Yii::$app->user->logout();
				return $this->goHome();
			}else{
				$js='$("#confirm-permission-alert").modal("show")';
				$this->getView()->registerJs($js);
				return $this->render('index');
			}
			
        }

    }
	
    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        }else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
		
    }

	/**
     * Ajax
     * Signs user up.
     * @return mixed
     */
    public function actionSignupFront()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->renderAjax('signup', [
            'model' => $model,
        ]);
	}
	
    /**
     * Ajax
     * Signs user up.
     * @return mixed
     */
    public function actionHomeFront()
    {
        return $this->renderAjax('home');
    }
	
	
	
    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
