<?php

namespace frontend\backend\laporan\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use frontend\backend\laporan\models\ComponenBulan;
use frontend\backend\laporan\models\TransPenjualanHeaderSummaryMonthly;
use frontend\backend\laporan\models\TransPenjualanHeaderSummaryMonthlySearch;
use frontend\backend\laporan\models\TransPengeluaranSummaryMonthlySearch;

class ArusUangController extends Controller
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
		
		$paramCari=Yii::$app->getRequest()->getQueryParam('id');
		if ($paramCari!=''){
			$cari=['thn'=>$paramCari];			
		}else{
			$cari=['thn'=>date('Y')];			
		};
		
		/*==========================
		* ARUS KAS MASUK & KELUAR
		*===========================*/
        $searchModel = new TransPenjualanHeaderSummaryMonthlySearch($cari);
        $dataProvider = $searchModel->searchKasMasukYear(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'cari'=>$cari
        ]);
    }	
	
	public function actionView($id)
	{
		return $this->render('view');
	}
	 public function actionDetailLev1()
    {
		
		$paramCari=Yii::$app->getRequest()->getQueryParam('id');
		$paramBln=Yii::$app->getRequest()->getQueryParam('bln');
		// print_r($paramCari);die();
		if ($paramCari!=''){
			$cari=['thn'=>$paramCari];			
		}else{
			$cari=['thn'=>date('Y')];			
		};
		
		/*==========================
		* ARUS KAS MASUK & KELUAR
		*===========================*/
        $searchModel = new TransPenjualanHeaderSummaryMonthlySearch(['thn'=>$cari['thn'],'BULAN'=>$paramBln]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		//Kas-Keluar		
		$searchModelKeluar = new TransPengeluaranSummaryMonthlySearch();
        $dataProviderKeluar = $searchModelKeluar->search(Yii::$app->request->queryParams);
		
		switch ($paramBln) {
			case 1:
				$bln="Januari";
				break;
			case 2:
				$bln="Febuari";
				break;
			case 3:
				$bln="Maret";
				break;
			case 4:
				$bln="April";
				break;
			case 5:
				$bln="Mei";
				break;
			case 6:
				$bln="Juni";
				break;
			case 7:
				$bln="Juli";
				break;
			case 8:
				$bln="Agustus";
				break;
			case 9:
				$bln="September";
				break;
			case 10:
				$bln="Oktober";
				break;
			case 11:
				$bln="November";
				break;
			case 12:
				$bln="Desember";
				break;
			default:
				$bln="Bulan tidak ada";
				break;
		}

        return $this->render('index1', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataProviderKeluar' => $dataProviderKeluar,
			'cari'=>$cari,
			'bln'=>$bln
        ]);
    }	
}
