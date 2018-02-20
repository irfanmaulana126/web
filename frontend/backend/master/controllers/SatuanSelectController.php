<?php

namespace frontend\backend\master\controllers;

use yii;
use yii\helpers\Json;
// use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;;
use yii\filters\ContentNegotiator;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\ArrayHelper;
use yii\web\HttpException;
use yii\web\Controller;
use yii\data\ArrayDataProvider;

//use frontend\backend\master\models\Item;
use frontend\backend\master\models\SatuanSelect;

class SatuanSelectController extends Controller
{
	public function behaviors(){
        return ArrayHelper::merge(parent::behaviors(), [
			'bootstrap'=> [
				'class' => ContentNegotiator::className(),
				'formats' => [
					'application/json' => Response::FORMAT_JSON,
				],
			]
        ]);
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
    public function actionIndex()
    {	
		 $params     = isset($_REQUEST['q'])?$_REQUEST['q']:'';
		 $store_code     = isset($_REQUEST['store_code'])?$_REQUEST['store_code']:'';
		 $searchModel = new SatuanSelect();
		// return $searchModel->search($param['q']);
		 //$param=["PenjualanHeaderSearch"=>'text=erma'];
		 //$data=$searchModel->search(Yii::$app->request->queryParams);
		 $data=$searchModel->search(['SatuanSelect'=>['store_code'=>$store_code,'text'=>$params]]);
		// return $data;
		 return ['results'=>$data];
		// print_r($data);
    }
	
	/* public function actionIndex()
    {		
		$model = Item::findOne('0001');//()->where(['outlet_code'=>'0001'])->All();		
		$valSatuan = $model->satuanFilter;//
		 
		foreach($valSatuan as $row => $val){
			$data[]=['id'=>$val['SATUAN_NM'],'text'=>$val['SATUAN_NM']];			 
		}	
		return ['results'=>$data];
    } */
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}
