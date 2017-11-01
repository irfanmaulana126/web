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
	
	 public function actionDetailLev1()
    {
		
		$paramCari=Yii::$app->getRequest()->getQueryParam('id');
		$paramBln=Yii::$app->getRequest()->getQueryParam('bln');
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
	
        return $this->render('index1', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataProviderKeluar' => $dataProviderKeluar,
			'cari'=>$cari,
			'paramBln'=>$paramBln
        ]);
    }	
}
