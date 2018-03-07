<?php

namespace frontend\backend\hris\controllers;

use Yii;
use frontend\backend\hris\models\AbsenRekap;
use frontend\backend\hris\models\AbsenRekapSearch;
use yii\web\Controller;
use yii\data\ArrayDataProvider;
use ptrnov\postman4excel\Postman4ExcelBehavior;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AbsenRekapController implements the CRUD actions for AbsenRekap model.
 */
class AbsenRekapController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            /*EXCEl IMPORT*/
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
     * Lists all AbsenRekap models.
     * @return mixed
     */
    public function actionIndex()
    {
        $paramCari='';
		//PencarianIndex
		$modelPeriode = new \yii\base\DynamicModel([
			'TAHUNBULAN','TAHUN','BULAN'
		]);		
		$modelPeriode->addRule(['TAHUNBULAN'], 'required')
         ->addRule(['TAHUNBULAN','TAHUN','BULAN'], 'safe');			
		if ($modelPeriode->load(Yii::$app->request->post())) {
			$hsl = \Yii::$app->request->post();	
			$paramCari=$hsl['DynamicModel']['TAHUNBULAN'];
		};		
		
		//PUBLIC PARAMS	
		$cari=['WAKTU_MASUK'=>$paramCari];	
		// print_r($cari);die();
		//DINAMIK MODEL PARAMS
        $searchModel = new AbsenRekapSearch($cari);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		// print_r($dataProvider);die();
		if(empty($dataProvider)){
			Yii::$app->session->setFlash('error', "Data Tidak ada");
			// $this->redirect(array('/inventory/stock-product'));
			return $this->render('index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
				// 'paramCari'=>$paramCari
			]);
		}else{
			return $this->render('index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
				// 'paramCari'=>$paramCari
			]);
		}
    }

    public function actionPencarianIndex(){
		$modelPeriode = new \yii\base\DynamicModel([
			'TAHUNBULAN','TAHUN','BULAN'
		]);		
		$modelPeriode->addRule(['TAHUNBULAN'], 'required')
         ->addRule(['TAHUNBULAN','TAHUN','BULAN'], 'safe');
		 
		if (!$modelPeriode->load(Yii::$app->request->post())) {
			return $this->renderAjax('form_cari',[
				'modelPeriode' => $modelPeriode
			]);
		}
    }
    public function actionPencarianExport(){
		$modelPeriode = new \yii\base\DynamicModel([
			'TAHUNBULAN','TAHUN','BULAN'
		]);		
		$modelPeriode->addRule(['TAHUNBULAN'], 'required')
         ->addRule(['TAHUNBULAN','TAHUN','BULAN'], 'safe');
		 
		if (!$modelPeriode->load(Yii::$app->request->post())) {
			return $this->renderAjax('form_cari_export',[
				'modelPeriode' => $modelPeriode
			]);
		}
    }
    
    public function actionExport()
    { 
        $paramCari='';
		//PencarianIndex
		$modelPeriode = new \yii\base\DynamicModel([
			'TAHUNBULAN','TAHUN','BULAN'
		]);		
		$modelPeriode->addRule(['TAHUNBULAN'], 'required')
         ->addRule(['TAHUNBULAN','TAHUN','BULAN'], 'safe');			
		if ($modelPeriode->load(Yii::$app->request->post())) {
			$hsl = \Yii::$app->request->post();	
			$paramCari=$hsl['DynamicModel']['TAHUNBULAN'];
		};		
		
		//PUBLIC PARAMS	
		$cari=['WAKTU_MASUK'=>$paramCari];	
		// print_r($cari);die();
		//DINAMIK MODEL PARAMS
        $searchModel = new AbsenRekapSearch($cari);
        $dataProvider = $searchModel->searchExcelExport(Yii::$app->request->queryParams);
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

            $searchModel = new AbsenRekapSearch($cari);
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            Yii::$app->session->setFlash('error', "Data Tidak ada padat TANGGAL ".$paramCari."");
			// $this->redirect(array('/inventory/stock-product'));
			return $this->render('index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
				// 'paramCari'=>$paramCari
			]);
        }
    }
    /**
     * Displays a single AbsenRekap model.
     * @param string $ID
     * @param string $STORE_ID
     * @param string $KARYAWAN_ID
     * @param integer $YEAR_AT
     * @param integer $MONTH_AT
     * @return mixed
     */
    public function actionView($ID, $STORE_ID, $KARYAWAN_ID, $YEAR_AT, $MONTH_AT)
    {
        return $this->render('view', [
            'model' => $this->findModel($ID, $STORE_ID, $KARYAWAN_ID, $YEAR_AT, $MONTH_AT),
        ]);
    }

    /**
     * Creates a new AbsenRekap model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AbsenRekap();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ID' => $model->ID, 'STORE_ID' => $model->STORE_ID, 'KARYAWAN_ID' => $model->KARYAWAN_ID, 'YEAR_AT' => $model->YEAR_AT, 'MONTH_AT' => $model->MONTH_AT]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AbsenRekap model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $ID
     * @param string $STORE_ID
     * @param string $KARYAWAN_ID
     * @param integer $YEAR_AT
     * @param integer $MONTH_AT
     * @return mixed
     */
    public function actionUpdate($ID, $STORE_ID, $KARYAWAN_ID, $YEAR_AT, $MONTH_AT)
    {
        $model = $this->findModel($ID, $STORE_ID, $KARYAWAN_ID, $YEAR_AT, $MONTH_AT);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ID' => $model->ID, 'STORE_ID' => $model->STORE_ID, 'KARYAWAN_ID' => $model->KARYAWAN_ID, 'YEAR_AT' => $model->YEAR_AT, 'MONTH_AT' => $model->MONTH_AT]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AbsenRekap model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $ID
     * @param string $STORE_ID
     * @param string $KARYAWAN_ID
     * @param integer $YEAR_AT
     * @param integer $MONTH_AT
     * @return mixed
     */
    public function actionDelete($ID, $STORE_ID, $KARYAWAN_ID, $YEAR_AT, $MONTH_AT)
    {
        $this->findModel($ID, $STORE_ID, $KARYAWAN_ID, $YEAR_AT, $MONTH_AT)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AbsenRekap model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $ID
     * @param string $STORE_ID
     * @param string $KARYAWAN_ID
     * @param integer $YEAR_AT
     * @param integer $MONTH_AT
     * @return AbsenRekap the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ID, $STORE_ID, $KARYAWAN_ID, $YEAR_AT, $MONTH_AT)
    {
        if (($model = AbsenRekap::findOne(['ID' => $ID, 'STORE_ID' => $STORE_ID, 'KARYAWAN_ID' => $KARYAWAN_ID, 'YEAR_AT' => $YEAR_AT, 'MONTH_AT' => $MONTH_AT])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
