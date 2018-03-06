<?php

namespace frontend\backend\hris\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\backend\hris\models\PenggajianRekapSearch;
use frontend\backend\sistem\models\StoreSearch;


class PenggajianRekapController extends Controller
{
	/**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
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
    /**
     * Lists all HrdAbsenRekap models.
     * @return mixed
     */
    public function actionIndex()
    {
        $user = (empty(Yii::$app->user->identity->ACCESS_ID)) ? '' : Yii::$app->user->identity->ACCESS_ID;
        
        $paramCari=Yii::$app->getRequest()->getQueryParam('storeid');
        // print_r($paramCari);die();
        if ($paramCari==''){
            $modelGrp =Yii::$app->db->createCommand("select * from hrd_absen_rekap where ACCESS_GROUP ='".$user."' ORDER BY STORE_ID ASC")->queryOne();
            $cari = ['STORE_ID'=>$modelGrp['STORE_ID']];
            // print_r($cari);die();
            $searchModel = new PenggajianRekapSearch($cari);
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        }else{
            $searchModelKasir = new PenggajianRekapSearch(['ACCESS_GROUP'=>$user,'STORE_ID'=>$paramCari]);
            $dataProviderKasir = $searchModelKasir->search(Yii::$app->request->queryParams);
        }

        $searchModelstore = new StoreSearch(['ACCESS_GROUP'=>$user]);
        $dataProviderstore = $searchModelstore->search(Yii::$app->request->queryParams);
        

        $searchModel = new PenggajianRekapSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		// print_r($dataProvider);
		// die();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataProviderstore' => $dataProviderstore,
        ]);
    }

}
