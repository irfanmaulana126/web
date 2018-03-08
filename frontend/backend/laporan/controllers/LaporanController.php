<?php

namespace frontend\backend\laporan\controllers;

use Yii;
use frontend\backend\laporan\models\JurnalTemplateTitleSearch;
use frontend\backend\laporan\models\JurnalTransaksiBulanSearch;
use common\models\Store;

class LaporanController extends \yii\web\Controller
{
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
        return $this->render('index');
    }
    public function actionIndexArus()
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
		
		/*==========================
		* ARUS KAS MASUK & KELUAR
		*===========================*/
		// print_r($cari);die();
        $searchModel = new JurnalTemplateTitleSearch(['RPT_GROUP_NM'=>'ARUS KAS']);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
        return $this->render('/arus-uang/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'cari'=>$cari,
			'store'=>$stores
        ]);
    }
    public function actionIndexPenjualan()
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
		
        $searchModel = new JurnalTemplateTitleSearch(['RPT_GROUP_NM'=>'PENJUALAN']);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('/sales/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'cari'=>$cari,
			'store'=>$stores
        ]);
    }
    public function actionIndexJurnal()
    {
        $user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;    

        $searchModel = new JurnalTransaksiBulanSearch(['ACCESS_GROUP'=>$user,'TAHUN'=>date('Y'),'BULAN'=>date('n')]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('/jurnal-transaksi-bulan/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionIndexBuku()
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

        return $this->render('/buku-besar/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'cari'=>$cari,
			'store'=>$stores
        ]);
    }
    public function actionIndexNeraca()
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
		
        $searchModel = new JurnalTemplateTitleSearch(['RPT_GROUP_NM'=>'Neraca']);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('/neraca/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'cari'=>$cari,
			'store'=>$stores
        ]);
    }
    public function actionIndexPpob()
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
		
        $searchModel = new JurnalTemplateTitleSearch(['RPT_GROUP_NM'=>'Neraca']);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('/ppob/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'cari'=>$cari,
			'store'=>$stores
        ]);
    }
    public function actionIndexDonasi()
    {
        return $this->render('/donasi/index');
    }
    public function actionIndexDompet()
    {
        return $this->render('/dompet/index');
    }

}
