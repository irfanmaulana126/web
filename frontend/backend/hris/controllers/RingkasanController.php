<?php

namespace frontend\backend\hris\controllers;

use yii\web\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class RingkasanController extends Controller
{
	//http://guzzle.readthedocs.io/en/latest/overview.html
    public function actionIndex()
    {
      	// 
		$client = new Client(['base_uri' => 'http://production.kontrolgampang.com/laporan/trans-rpt2s?TGL=2017-10-31']);
		//$request = new \GuzzleHttp\Psr7\Request('GET', 'TGL');
		print_r($client);
	}
	public function beforeAction($action){
        $modulIndentify=4; //OUTLET
       // Check only when the user is logged in.
       // Author piter Novian [ptr.nov@gmail.com].
       if (!Yii::$app->user->isGuest){
           if (Yii::$app->session['userSessionTimeout']< time() ) {
               // timeout
               Yii::$app->user->logout();
               return $this->goHome(); 
           } else {	
               //add Session.
               Yii::$app->session->set('userSessionTimeout', time() + Yii::$app->params['sessionTimeoutSeconds']);
               //check validation [access/url].
               $checkAccess=Yii::$app->getUserOpt->UserMenuPermission($modulIndentify);
               if($checkAccess['modulMenu']['MODUL_STS']==0 OR $checkAccess['ModulPermission']['STATUS']==0){				
                   $this->redirect(array('/site/alert'));
               }else{
                   if($checkAccess['PageViewUrl']==true){						
                       return true;
                   }else{
                       $this->redirect(array('/site/alert'));
                   }					
               }			 
           }
       }else{
           Yii::$app->user->logout();
           return $this->goHome(); 
       }
   }
}
