<?php

namespace frontend\backend\hris\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;
use ptrnov\postman4excel\Postman4ExcelBehavior;
use frontend\backend\hris\models\Karyawan;
use frontend\backend\hris\models\KaryawanSearch;

/**
 * KaryawanController implements the CRUD actions for Karyawan model.
 */
class KaryawanController extends Controller
{
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
     * Lists all Karyawan models.
     * @return mixed
     */
    public function actionIndex()
    {
		$user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
        $searchModel = new KaryawanSearch(['ACCESS_GROUP'=>$user]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

	/**=====================
	* KARYAWAN CREATE
	* @return mixed
	=========================*/
    public function actionCreate()
    {
        $model = new Karyawan();

        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
            return $this->redirect(['index']);
        } else {
            return $this->renderAjax('form_create', [
				'model' => $model,
			]);
        }
    }
	
	
    /**
     * Displays a single Karyawan model.
     * @param string $ID
     * @param string $STORE_ID
     * @param string $KARYAWAN_ID
     * @param integer $YEAR_AT
     * @param integer $MONTH_AT
     * @return mixed
     */
    public function actionView($id)
    {
        $model= Karyawan::findOne(['ID' => $id]);
        return $this->renderAjax('view', [
            'model' => $model,
        ]);
    }
	
	public function actionEdit($id)
    {
		$model= Karyawan::findOne(['ID' => $id]);
		if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
            return $this->redirect(['index']);
        } else {
			return $this->renderAjax('form_edit', [
				'model' => $model,
			]);
        }
    }
	public function actionHapus($id)
    {
		$model= Karyawan::findOne(['ID' => $id]);
		$model->STATUS='3';
		$model->save(false);
		return $this->redirect(['index']);
    }
	public function actionDisable($id)
    {
		$model= Karyawan::findOne(['ID' => $id]);
		$model->STATUS='0';
		$model->save(false);
		return $this->redirect(['index']);
    }
	public function actionEneble($id)
    {
		$model= Karyawan::findOne(['ID' => $id]);
		$model->STATUS='1';
		$model->save(false);
		return $this->redirect(['index']);
    }
	public function actionRestore(){
       
        $user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
        // print_r($user);die();
        $modelPeriode = new Karyawan();
        $datas = KaryawanSearch::find()->where(['and','ACCESS_GROUP='.$user.'','STATUS=3'])->all();
        $items = ArrayHelper::map($datas, 'KARYAWAN_ID', function($datas)
		{
			return $datas->NAMA_DPN.' '.$datas->NAMA_TGH.' '.$datas->NAMA_BLK.'/'.$datas->KTP;
		});
        // print_r($items);die();
		if ($modelPeriode->load(Yii::$app->request->post())) {
                // $modelPeriode;
                // print_r($modelPeriode);die();
            foreach ($modelPeriode['STATUS'] as $value) {
                $datas = Karyawan::findOne(['KARYAWAN_ID' => $value]);
                $datas->STATUS=0;
                // print_r($datas);die();
                $datas->save(false);
            }
            
	// $id=Yii::$app->request->cookies;
    //         $storeId=$id->getValue('KARYAWAN_ID');
    //         print_r($storeId);die();
            $tes=Yii::$app->response->cookies->remove('KARYAWAN_ID');
            // print_r($tes);die();
            
            Yii::$app->session->setFlash('success', "Restore Berhasil");
            return $this->redirect('/hris/karyawan');
        }else {
            return $this->renderAjax('form_restore',[
				'modelPeriode' => $modelPeriode,
                'items'=>$items
			]);
	   }
	}
   public function actionExport()
    {
		$searchModel = new KaryawanSearch();
        $dataProvider = $searchModel->searchExcelExport(Yii::$app->request->queryParams);
		$model=$dataProvider->allModels;
		// $arDataProvider= new ArrayDataProvider([	
			// 'allModels'=>$dt,	
			// 'pagination' => [
				// 'pageSize' =>10000,
			// ],			
		// ]);		
		// $model=$arDataProvider->getModels();
		// $model->attributes;
		//$model=Karyawan::find()->asArray()->all();
		//->where(['ACCESS_GROUP'=>Yii::$app->getUserOpt->user()['ACCESS_GROUP']])->asArray()->all();
		//$model->attributes;
		// print_r($model);
		// die();
		
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

		// return $this->redirect(['index']);
    }

  
}
