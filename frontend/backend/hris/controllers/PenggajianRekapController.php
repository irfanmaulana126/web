<?php

namespace frontend\backend\hris\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\backend\hris\models\PenggajianRekapSearch;
use frontend\backend\hris\models\StoreSearch;
use frontend\backend\hris\models\HrdSettingPeriode;
use ptrnov\postman4excel\Postman4ExcelBehavior;


class PenggajianRekapController extends Controller
{
	/**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'export4excel' => [
            'class' => Postman4ExcelBehavior::className(),
            'widgetType'=>'download',
        ], 
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
        $user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
        $tanggal='';

        $modelPeriode = new \yii\base\DynamicModel([
			'TAHUNBULAN','TAHUN','BULAN'
		]);		
		$modelPeriode->addRule(['TAHUNBULAN'], 'required')
         ->addRule(['TAHUNBULAN','TAHUN','BULAN'], 'safe');			
		if ($modelPeriode->load(Yii::$app->request->post())) {
			$hsl = \Yii::$app->request->post();	
			$tanggal=$hsl['DynamicModel']['TAHUNBULAN'];
        };		
        
        $paramCari=Yii::$app->getRequest()->getQueryParam('storeid');
        if ($paramCari==''){
            $modelGrp =Yii::$app->db->createCommand("select * from hrd_absen_rekap where ACCESS_GROUP ='".$user."' ORDER BY STORE_ID ASC")->queryOne();
            $cari = ['STORE_ID'=>$modelGrp['STORE_ID']];
            $search = HrdSettingPeriode::findOne(['ACCESS_GROUP'=>$user,'STORE_ID'=>$modelGrp['STORE_ID']]);
            if ($tanggal=='') {
                $date1=date('Y-m');
                $date2=date('Y-m',strtotime('-1 month', strtotime($date1)));
                $date=[
                    'tanggal1'=>$date1.'-'.$search['TGL1'],
                    'tanggal2'=>$date2.'-'.$search['TGL2']
                ];
                $searchModel = new PenggajianRekapSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$cari,$date);
            } else {
                $date1=$tanggal;
                $date2=date('Y-m',strtotime('-1 month', strtotime($date1)));
                $date=[
                    'tanggal1'=>$date1.'-'.$search['TGL1'],
                    'tanggal2'=>$date2.'-'.$search['TGL2']
                ];
                $searchModel = new PenggajianRekapSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$cari,$date);
            }            
        }else{
            $cari = ['STORE_ID'=>$paramCari];
            $search = HrdSettingPeriode::findOne(['ACCESS_GROUP'=>$user,'STORE_ID'=>$paramCari]);
            if ($tanggal=='') {
                $date1=date('Y-m');
                $date2=date('Y-m',strtotime('-1 month', strtotime($date1)));
                $date=[
                    'tanggal1'=>$date1.'-'.$search['TGL1'],
                    'tanggal2'=>$date2.'-'.$search['TGL2']
                ];
                $searchModel = new PenggajianRekapSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$cari,$date);
            } else {
                $date1=$tanggal;
                $date2=date('Y-m',strtotime('-1 month', strtotime($date1)));
                $date=[
                    'tanggal1'=>$date1.'-'.$search['TGL1'],
                    'tanggal2'=>$date2.'-'.$search['TGL2']
                ];
                $searchModel = new PenggajianRekapSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$cari,$date);
            }
        }

        $searchModelstore = new StoreSearch(['ACCESS_GROUP'=>$user]);
        $dataProviderstore = $searchModelstore->search(Yii::$app->request->queryParams);
        $modelGrp =Yii::$app->db->createCommand("select * from hrd_absen_rekap where ACCESS_GROUP ='".$user."' ORDER BY STORE_ID ASC")->queryOne();
        $store = (empty($paramCari)) ? $modelGrp['STORE_ID'] : $paramCari ;
		// print_r($dataProvider);
		// die();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataProviderstore' => $dataProviderstore,
            'date'=>$date,
            'store'=>$store
        ]);
    }
    public function actionPencarianIndex($paramCari){
		$modelPeriode = new \yii\base\DynamicModel([
			'TAHUNBULAN','TAHUN','BULAN'
		]);		
		$modelPeriode->addRule(['TAHUNBULAN'], 'required')
         ->addRule(['TAHUNBULAN','TAHUN','BULAN'], 'safe');
		 
		if (!$modelPeriode->load(Yii::$app->request->post())) {
			return $this->renderAjax('form_cari',[
				'modelPeriode' => $modelPeriode,
                'store'=>$paramCari
			]);
		}
    }
    public function actionPencarianExport($store){
		$modelPeriode = new \yii\base\DynamicModel([
			'TAHUNBULAN','TAHUN','BULAN'
		]);		
		$modelPeriode->addRule(['TAHUNBULAN'], 'required')
         ->addRule(['TAHUNBULAN','TAHUN','BULAN'], 'safe');
		 
		if (!$modelPeriode->load(Yii::$app->request->post())) {
			return $this->renderAjax('form_cari_export',[
				'modelPeriode' => $modelPeriode,
                'store'=>$store
			]);
		}
    }
    public function actionExport($storeid)
    { 
        $tanggal='';
		//PencarianIndex
		$modelPeriode = new \yii\base\DynamicModel([
			'TAHUNBULAN','TAHUN','BULAN'
		]);		
		$modelPeriode->addRule(['TAHUNBULAN'], 'required')
         ->addRule(['TAHUNBULAN','TAHUN','BULAN'], 'safe');			
		if ($modelPeriode->load(Yii::$app->request->post())) {
			$hsl = \Yii::$app->request->post();	
			$tanggal=$hsl['DynamicModel']['TAHUNBULAN'];
        };
        $user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
        $modelGrp =Yii::$app->db->createCommand("select * from hrd_absen_rekap where ACCESS_GROUP ='".$user."' ORDER BY STORE_ID ASC")->queryOne();		
        $search = HrdSettingPeriode::findOne(['ACCESS_GROUP'=>$user,'STORE_ID'=>$modelGrp['STORE_ID']]);
        $date1=$tanggal;
        $date2=date('Y-m',strtotime('-1 month', strtotime($date1)));
        $date=[
            'tanggal1'=>$date1.'-'.$search['TGL1'],
            'tanggal2'=>$date2.'-'.$search['TGL2']
        ];
		//PUBLIC PARAMS	
		$cari=['STORE_ID'=>$storeid,'tanggal1'=>$date1.'-'.$search['TGL1'],'tanggal2'=>$date2.'-'.$search['TGL2']];	
        //DINAMIK MODEL PARAMS
        $searchModel = new PenggajianRekapSearch();
        $dataProvider = $searchModel->searchExcelExport(Yii::$app->request->queryParams,$cari);
        $model=$dataProvider->allModels;
        if (!empty($model)) {
            $excel_dataKaryawan= Postman4ExcelBehavior::excelDataFormat($model);		
        $excel_titleDatakaryawan = $excel_dataKaryawan['excel_title'];
        $excel_ceilsDatakaryawan = $excel_dataKaryawan['excel_ceils'];

		
		//DATA IMPORT
        // print_r($excel_dataKaryawan);die();
		$excel_content[] = 
			[
				'sheet_name' => 'data-karyawan',
                'sheet_title' => [
					['ID','ACCESS_GROUP','STORE_ID','KARYAWAN_ID','NAMA_DPN','NAMA_TGH','NAMA_BLK','KTP','TMP_LAHIR','TGL_LAHIR','GENDER','ALAMAT','STS_NIKAH','TLP','HP','EMAIL','UPAH_HARIAN','STT_POT_TELAT','STT_POT_PULANG','STT_IZIN','STT_LEMBUR','CREATE_BY','CREATE_AT','UPDATE_BY','UPDATE_AT','STATUS','DCRP_DETIL','YEAR_AT','MONTH_AT']
				],
			    'ceils' => $excel_ceilsDatakaryawan,
				'freezePane' => 'A2',
				'columnGroup'=>false,
				'autoSize'=>false,
                'headerColor' => Postman4ExcelBehavior::getCssClass("header"),
                'headerStyle'=>[	
					[
						'ACCESS_GROUP' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],
						'STORE_ID' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],
						'KARYAWAN_ID' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],
						'NAMA_DPN' =>['font-size'=>'9','width'=>'17','valign'=>'center','align'=>'center'],
						'NAMA_TGH' =>['font-size'=>'9','width'=>'7','valign'=>'center','align'=>'center'],
						'NAMA_BLK' =>['font-size'=>'9','width'=>'7','valign'=>'center','align'=>'center'],
						'KTP' =>['font-size'=>'9','width'=>'7','valign'=>'center','align'=>'center'],
						'TMP_LAHIR' =>['font-size'=>'9','width'=>'7','valign'=>'center','align'=>'center'],
						'TGL_LAHIR' =>['font-size'=>'9','width'=>'7','valign'=>'center','align'=>'center'],
						'ALAMAT' =>['font-size'=>'9','width'=>'7','valign'=>'center','align'=>'center'],
						'STS_NIKAH' =>['font-size'=>'9','width'=>'7','valign'=>'center','align'=>'center'],
						'TLP' =>['font-size'=>'9','width'=>'7','valign'=>'center','align'=>'center'],
						'HP' =>['font-size'=>'9','width'=>'7','valign'=>'center','align'=>'center'],
						'EMAIL' =>['font-size'=>'9','width'=>'7','valign'=>'center','align'=>'center'],
						'UPAH_HARIAN' =>['font-size'=>'9','width'=>'7','valign'=>'center','align'=>'center'],
						'STT_POT_TELAT' =>['font-size'=>'9','width'=>'7','valign'=>'center','align'=>'center'],
						'STT_POT_PULANG' =>['font-size'=>'9','width'=>'7','valign'=>'center','align'=>'center'],
						'STT_IZIN' =>['font-size'=>'9','width'=>'7','valign'=>'center','align'=>'center'],
						'STT_LEMBUR' =>['font-size'=>'9','width'=>'7','valign'=>'center','align'=>'center'],
						'CREATE_BY' =>['font-size'=>'9','width'=>'7','valign'=>'center','align'=>'center'],
						'CREATE_AT' =>['font-size'=>'9','width'=>'7','valign'=>'center','align'=>'center'],
						'UPDATE_BY' =>['font-size'=>'9','width'=>'7','valign'=>'center','align'=>'center'],
						'UPDATE_AT' =>['font-size'=>'9','width'=>'7','valign'=>'center','align'=>'center'],
						'STATUS' =>['font-size'=>'9','width'=>'7','valign'=>'center','align'=>'center'],
						'DCRP_DETIL' =>['font-size'=>'9','width'=>'7','valign'=>'center','align'=>'center'],
						'YEAR_AT' =>['font-size'=>'9','width'=>'7','valign'=>'center','align'=>'center'],
						'MONTH_AT' =>['font-size'=>'9','width'=>'7','valign'=>'center','align'=>'center']				
				],
			],
				'contentStyle'=>[
					[						
						'ACCESS_GROUP' =>['font-size'=>'8','valign'=>'center','align'=>'left'],
						'STORE_ID' =>['font-size'=>'8','valign'=>'center','align'=>'left'],
						'KARYAWAN_ID' =>['font-size'=>'8','valign'=>'center','align'=>'left'],
						'NAMA_DPN' =>['font-size'=>'8','valign'=>'center','align'=>'left'],
						'NAMA_TGH' =>['font-size'=>'8','valign'=>'right','align'=>'RIGHT'],
						'NAMA_BLK' =>['font-size'=>'8','valign'=>'right','align'=>'RIGHT'],
						'KTP' =>['font-size'=>'8','valign'=>'right','align'=>'RIGHT'],
						'TMP_LAHIR' =>['font-size'=>'8','valign'=>'right','align'=>'RIGHT'],
						'TGL_LAHIR' =>['font-size'=>'8','valign'=>'right','align'=>'RIGHT'],
						'ALAMAT' =>['font-size'=>'8','valign'=>'right','align'=>'RIGHT'],
						'STS_NIKAH' =>['font-size'=>'8','valign'=>'right','align'=>'RIGHT'],
						'TLP' =>['font-size'=>'8','valign'=>'right','align'=>'RIGHT'],
						'HP' =>['font-size'=>'8','valign'=>'right','align'=>'RIGHT'],
						'EMAIL' =>['font-size'=>'8','valign'=>'center','align'=>'left'],
						'UPAH_HARIAN' =>['font-size'=>'8','valign'=>'center','align'=>'left'],
						'STT_POT_TELAT' =>['font-size'=>'8','valign'=>'right','align'=>'RIGHT'],
						'STT_POT_PULANG' =>['font-size'=>'8','valign'=>'right','align'=>'RIGHT'],
						'STT_IZIN' =>['font-size'=>'8','valign'=>'right','align'=>'RIGHT'],
						'STT_LEMBUR' =>['font-size'=>'8','valign'=>'right','align'=>'RIGHT'],
						'CREATE_BY' =>['font-size'=>'8','valign'=>'right','align'=>'RIGHT'],
						'CREATE_AT' =>['font-size'=>'8','valign'=>'right','align'=>'RIGHT'],
						'UPDATE_BY' =>['font-size'=>'8','valign'=>'right','align'=>'RIGHT'],
						'UPDATE_AT' =>['font-size'=>'8','valign'=>'right','align'=>'RIGHT'],
						'STATUS' =>['font-size'=>'8','valign'=>'right','align'=>'RIGHT'],
						'DCRP_DETIL' =>['font-size'=>'8','valign'=>'right','align'=>'RIGHT'],
						'YEAR_AT' =>['font-size'=>'8','valign'=>'right','align'=>'RIGHT'],
						'MONTH_AT' =>['font-size'=>'8','valign'=>'right','align'=>'RIGHT']
					]
				],
			'oddCssClass' => Postman4ExcelBehavior::getCssClass("odd"),
			'evenCssClass' => Postman4ExcelBehavior::getCssClass("even"),			
		];
		// print_r($excel_ceilsDatakaryawan);
		// die();
		$excel_file = "data-karyawan";
		$this->export4excel($excel_content, $excel_file,0); 
        } else {
            $cari = ['STORE_ID'=>$storeid];
            $searchModel = new PenggajianRekapSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$cari,$date);
            Yii::$app->session->setFlash('error', "Data Tidak ada padat TANGGAL ".$date['tanggal1']." s/d ".$date['tanggal1']."");
            // $this->redirect(array('/inventory/stock-product'));
            $searchModelstore = new StoreSearch(['ACCESS_GROUP'=>$user]);
            $dataProviderstore = $searchModelstore->search(Yii::$app->request->queryParams);
            $modelGrp =Yii::$app->db->createCommand("select * from hrd_absen_rekap where ACCESS_GROUP ='".$user."' ORDER BY STORE_ID ASC")->queryOne();
            $store = (empty($tanggal)) ? $modelGrp['STORE_ID'] : $tanggal ;
			return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'dataProviderstore' => $dataProviderstore,
                'date'=>$date,
                'store'=>$store
            ]);
        }
    }
}
