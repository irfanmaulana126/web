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

    /**
     * Lists all Karyawan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KaryawanSearch();
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'ID' => $model->ID, 'STORE_ID' => $model->STORE_ID, 'KARYAWAN_ID' => $model->KARYAWAN_ID, 'YEAR_AT' => $model->YEAR_AT, 'MONTH_AT' => $model->MONTH_AT]);
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
        return $this->renderAjax('form_edit', [
            'model' => $model,
        ]);
    }
	
	public function actionEdit($id)
    {
		$model= Karyawan::findOne(['ID' => $id]);
        return $this->renderAjax('form_edit', [
            'model' => $model,
        ]);
    }

   public function actionExport()
    {
		$searchModel = new KaryawanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$model=$dataProvider->getModels();
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
		print_r($model);
		die();
		
		$excel_dataKaryawan= Postman4ExcelBehavior::excelDataFormat($model);		
        $excel_titleDatakaryawan = $excel_dataKaryawan['excel_title'];
        $excel_ceilsDatakaryawan = $excel_dataKaryawan['excel_ceils'];

		
		//DATA IMPORT
		$excel_content = [
			[
				'sheet_name' => 'data-karyawan',
                'sheet_title' => [
					$excel_titleDatakaryawan
				],
			    'ceils' => $excel_ceilsDatakaryawan,
                //'freezePane' => 'A3',
                'headerColor' => Postman4ExcelBehavior::getCssClass("header"),
                /* 'headerStyle'=>[	
					[
						'NAMA_TOKO' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],
						'PRODUK' =>['font-size'=>'9','width'=>'17','valign'=>'center','align'=>'center'],
						'LALU' =>['font-size'=>'9','width'=>'7','valign'=>'center','align'=>'center'],
						'MASUK' =>['font-size'=>'9','width'=>'7','valign'=>'center','align'=>'center'],
						'TERJUAL' =>['font-size'=>'9','width'=>'7','valign'=>'center','align'=>'center'],
						'SISA' =>['font-size'=>'9','width'=>'7','valign'=>'center','align'=>'center'],
						'Masuk' =>['font-size'=>'9','width'=>'7','valign'=>'center','align'=>'center'],
						'Keluar' =>['font-size'=>'9','width'=>'7','valign'=>'center','align'=>'center'],
						'Sisa' =>['font-size'=>'9','width'=>'7','valign'=>'center','align'=>'center'],
						'Closing' =>['font-size'=>'9','width'=>'7','valign'=>'center','align'=>'center'],
						'Actual' =>['font-size'=>'9','width'=>'7','valign'=>'center','align'=>'center'],
					]						
				],
				'contentStyle'=>[
					[						
						'NAMA_TOKO' =>['font-size'=>'8','valign'=>'center','align'=>'left'],
						'PRODUK'=>['font-size'=>'8','valign'=>'center','align'=>'left'],
						'LALU' =>['font-size'=>'8','valign'=>'right','align'=>'RIGHT'],
						'MASUK' =>['font-size'=>'8','valign'=>'right','align'=>'RIGHT'],
						'TERJUAL' =>['font-size'=>'8','valign'=>'right','align'=>'RIGHT'],
						'SISA' =>['font-size'=>'8','valign'=>'right','align'=>'RIGHT'],
						'Masuk' =>['font-size'=>'8','valign'=>'right','align'=>'RIGHT'],
						'Keluar' =>['font-size'=>'8','valign'=>'right','align'=>'RIGHT'],
						'Sisa' =>['font-size'=>'8','valign'=>'right','align'=>'RIGHT'],
						'Closing' =>['font-size'=>'8','valign'=>'right','align'=>'RIGHT'],
						'Actual' =>['font-size'=>'8','valign'=>'right','align'=>'RIGHT'],
					]
				], */
               'oddCssClass' => Postman4ExcelBehavior::getCssClass("odd"),
               'evenCssClass' => Postman4ExcelBehavior::getCssClass("even"),
			],
		];
		// print_r($excel_content);
		// die();
		$excel_file = "data-karyawan";
		$this->export4excel($excel_content, $excel_file,1); 
    }

  
}
