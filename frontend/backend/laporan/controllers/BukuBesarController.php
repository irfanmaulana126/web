<?php

namespace frontend\backend\laporan\controllers;

use Yii;
use yii\web\Controller;
use frontend\backend\laporan\models\JurnalTemplateTitle;
use frontend\backend\laporan\models\JurnalTemplateTitleSearch;
use common\models\Store;

class BukuBesarController extends Controller
{
    public function actionIndex()
    {
		$user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
		$paramCari=Yii::$app->getRequest()->getQueryParam('id');
		if ($paramCari!=''){
			$cari=$paramCari;	
		}else{
			$cari=date('Y-n');
		};
		$paramCari2=Yii::$app->getRequest()->getQueryParam('store');
		if ($paramCari2!=''){	
			$stores=store::find()->where(['ACCESS_GROUP'=>$user,'STORE_ID'=>$paramCari2])->orderBy(['STATUS'=>SORT_ASC])->one();					
		}else{
			$stores=store::find()->where(['ACCESS_GROUP'=>$user])->orderBy(['STATUS'=>SORT_ASC])->one();				
		};
		
        $searchModel = new JurnalTemplateTitleSearch(['RPT_GROUP_NM'=>'Buku Besar']);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'cari'=>$cari,
			'store'=>$stores
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

}
