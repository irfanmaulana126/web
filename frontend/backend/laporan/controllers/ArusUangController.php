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
use frontend\backend\laporan\models\JurnalTemplateTitle;
use frontend\backend\laporan\models\JurnalTemplateTitleSearch;
use frontend\backend\laporan\models\PtrKasirTd1Search;
use frontend\backend\laporan\models\PtrKasirTd1aSearch;
use frontend\backend\laporan\models\PtrKasirTd1bSearch;
use frontend\backend\laporan\models\PtrKasirTd1cSearch;
use frontend\backend\laporan\models\JurnalAkun;

use frontend\backend\laporan\models\LaporanArusKas;
use common\models\Store;

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
		$user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
		$paramCari=Yii::$app->getRequest()->getQueryParam('id');
		if ($paramCari!=''){
			$cari=$paramCari;	
		}else{
			$cari=date('Y-n-d');
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
		//print_r(date('Y',strtotime($cari)));die();
        // $searchModel = new JurnalTemplateTitleSearch(['RPT_GROUP_NM'=>'ARUS KAS']);
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$searchModel = new LaporanArusKas();
        $dataProvider = $searchModel->searchArusKeuangan(Yii::$app->request->queryParams);
		
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'cari'=>$cari,
			'store'=>$stores
        ]);
    }	
	
	/* public function actionDetailBulan($akunkode,$bulan,$store)
	{
		$date = explode('-',$bulan);
		$searchModel = new PtrKasirTd1aSearch(['BULAN'=>$date[1],'STORE_ID'=>$store]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$stores=store::find()->where(['STORE_ID'=>$store])->one();					
		$akun=JurnalAkun::find()->where(['AKUN_CODE'=>$akunkode])->one();					
		
        return $this->render('detail_bulan', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'store'=>$stores,
			'akun'=>$akun,
			'akunkode'=>$akunkode,
			'tanggal'=>$bulan
        ]);
	}
	
	public function actionDetailMinggu($akunkode,$minggu,$store)
	{
		$searchModel = new PtrKasirTd1bSearch(['BULAN'=>$bulan,'STORE_ID'=>$store]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('detail', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'store'=>$store
        ]);
	}
	public function actionDetailProduk($akunkode,$tgl,$store,$produk)
	{
		$searchModel = new PtrKasirTd1Search(['TRANS_DATE'=>$tgl,'STORE_ID'=>$store,'PRODUCT_ID'=>$produk]);
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$stores=store::find()->where(['STORE_ID'=>$store])->one();					
		$akun=JurnalAkun::find()->where(['AKUN_CODE'=>$akunkode])->one();	

        return $this->render('index_detail_produk', [
            'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
			'store'=>$stores,
			'akun'=>$akun,
			'akunkode'=>$akunkode,
			'tanggal'=>$tgl
        ]);
	}
	public function actionDetailHari($akunkode,$hari,$store)
	{
		$searchModel = new PtrKasirTd1cSearch(['BULAN'=>$bulan,'STORE_ID'=>$store]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('detail', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'store'=>$store
        ]);
	}
	public function actionView($id)
	{
		return $this->render('view');
	} */
	/*  public function actionDetailLev1()
    {
		
		$paramCari=Yii::$app->getRequest()->getQueryParam('id');
		$paramBln=Yii::$app->getRequest()->getQueryParam('bln');
		// print_r($paramCari);die();
		if ($paramCari!=''){
			$cari=['thn'=>$paramCari];			
		}else{
			$cari=['thn'=>date('Y')];			
		};
		 */
		/*==========================
		* ARUS KAS MASUK & KELUAR
		*===========================*/
       /*  $searchModel = new TransPenjualanHeaderSummaryMonthlySearch(['thn'=>$cari['thn'],'BULAN'=>$paramBln]);
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
    }	 */
}
