<?php

namespace frontend\backend\inventory\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\data\ArrayDataProvider;
use yii\base\DynamicModel;
use yii\web\Response;
use frontend\backend\inventory\models\StockOutSearch;
use ptrnov\postman4excel\Postman4ExcelBehavior;

class StockOpnameController extends Controller
{
	public function behaviors()
    {
        return [
			/*EXCEl IMPORT*/
			'export4excel' => [
				'class' => Postman4ExcelBehavior::className(),
				//'downloadPath'=>Yii::getAlias('@lukisongroup').'/cronjob/',
				//'downloadPath'=>'/var/www/backup/ExternalData/',
				'widgetType'=>'download',
			], 
            // 'verbs' => [
                // 'class' => VerbFilter::className(),
                // 'actions' => [
                    // 'delete' => ['POST'],
                // ],
            // ],
        ];
    }
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
			$paramCari=$hsl['DynamicModel']['TAHUNBULAN']."-01";
		};		
		
		//PUBLIC PARAMS	
		$cari=['thn'=>$paramCari];	
		
		//DINAMIK MODEL PARAMS
		$searchModel = new StockOutSearch($cari);
        $dataProvider = $searchModel->searchOpname(Yii::$app->request->queryParams);
		
		//LOAD DEFAULT INDEX
		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
			'paramCari'=>$paramCari
		]);	       
    }
	
	/**====================================
	* PENCARIAN INDEX VIEW
	* @return mixed
	* @author piter [ptr.nov@gmail.com]
	* @since 1.2
	* ====================================
	*/
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
	
	/**====================================
	* CLOSING STOCK - RUNNING
	* @return mixed
	* @author piter [ptr.nov@gmail.com]
	* @since 1.2
	* ====================================
	*/
	public function actionClosingStock(){
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
	
	/**====================================
	* DOWNLOAD OPNAME - FORMAT
	* @return mixed
	* @author piter [ptr.nov@gmail.com]
	* @since 1.2
	* ====================================
	*/
	public function actionDownload(){
		$modelPeriode = new \yii\base\DynamicModel([
			'TAHUNBULAN','TAHUN','BULAN'
		]);		
		$modelPeriode->addRule(['TAHUNBULAN'], 'required')
         ->addRule(['TAHUNBULAN','TAHUN','BULAN'], 'safe');
		 
		if (!$modelPeriode->load(Yii::$app->request->post())) {
			return $this->renderAjax('form_download',[
				'modelPeriode' => $modelPeriode
			]);
		}
	}
	
	/**====================================
	* UPLOAD OPNAME - FORMAT
	* @return mixed
	* @author piter [ptr.nov@gmail.com]
	* @since 1.2
	* ====================================
	*/
	public function actionUploadFile(){
		$modelPeriode = new \yii\base\DynamicModel([
			'uploadExport'
		]);		
		$modelPeriode->addRule(['uploadExport'], 'required')
         ->addRule(['uploadExport'], 'safe');
		 
		if (!$modelPeriode->load(Yii::$app->request->post())) {
			return $this->renderAjax('form_upload',[
				'modelPeriode' => $modelPeriode
			]);
		}
	}
	
	/**====================================
	* EXPORT DATA
	* @return mixed
	* @author piter [ptr.nov@gmail.com]
	* @since 1.2
	* ====================================
	*/
	public function actionExport(){
		$modelPeriode = new \yii\base\DynamicModel([
			'TAHUN'
		]);		
		$modelPeriode->addRule(['TAHUN'], 'required')
         ->addRule(['TAHUN'], 'safe');
		 
		if ($modelPeriode->load(Yii::$app->request->post())) {
		$id=$modelPeriode->TAHUN;
		// print_r($id);die();
		//DINAMIK MODEL PARAMS
		$searchModel = new StockOutSearch(['thn'=>$id]);
        $dataProvider = $searchModel->searchOpname(Yii::$app->request->queryParams);
		$dinamikField=$dataProvider->allModels;

		$excel_dataProdukStok = Postman4ExcelBehavior::excelDataFormat($dinamikField);
        $excel_titleProdukStok = $excel_dataProdukStok['excel_title'];
        $excel_ceilsProdukStok = $excel_dataProdukStok['excel_ceils'];

		
		// print_r($excel_titleProdukStok);
		// die();
		//DATA IMPORT
		$excel_content = [
			[
				'sheet_name' => 'Produk-Stok',
                'sheet_title' => [
					['Nama Toko','Access Group','Produk','Lalu','Masuk','Terjual','Sisa','Closing','Actual']
				],
				'ceils' => $excel_ceilsProdukStok,
				'freezePane' => 'A3',
				'columnGroup'=>false,
				'autoSize'=>false,
				'headerColor' => Postman4ExcelBehavior::getCssClass("header"),
                'headerStyle'=>[	
					[
						'STORE_NM' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],
						'ACCESS_GROUP' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],
						'NAMA_TOKO' =>['font-size'=>'9','width'=>'17','valign'=>'center','align'=>'center'],
						'TTL_LALU' =>['font-size'=>'9','width'=>'7','valign'=>'center','align'=>'center'],
						'TTL_MASUK' =>['font-size'=>'9','width'=>'7','valign'=>'center','align'=>'center'],
						'TTL_JUAL' =>['font-size'=>'9','width'=>'7','valign'=>'center','align'=>'center'],
						'TTL_SISA' =>['font-size'=>'9','width'=>'7','valign'=>'center','align'=>'center'],
						'Closing' =>['font-size'=>'9','width'=>'7','valign'=>'center','align'=>'center'],
						'Actual' =>['font-size'=>'9','width'=>'7','valign'=>'center','align'=>'center'],
					]						
				],
				'contentStyle'=>[
					[						
						'STORE_NM' =>['font-size'=>'8','valign'=>'center','align'=>'left'],
						'ACCESS_GROUP' =>['font-size'=>'8','valign'=>'center','align'=>'left'],
						'NAMA_TOKO'=>['font-size'=>'8','valign'=>'center','align'=>'left'],
						'TTL_LALU' =>['font-size'=>'8','valign'=>'right','align'=>'RIGHT'],
						'TTL_MASUK' =>['font-size'=>'8','valign'=>'right','align'=>'RIGHT'],
						'TTL_JUAL' =>['font-size'=>'8','valign'=>'right','align'=>'RIGHT'],
						'TTL_SISA' =>['font-size'=>'8','valign'=>'right','align'=>'RIGHT'],
						'Closing' =>['font-size'=>'8','valign'=>'right','align'=>'RIGHT'],
						'Actual' =>['font-size'=>'8','valign'=>'right','align'=>'RIGHT']
					]
				],
               'oddCssClass' => Postman4ExcelBehavior::getCssClass("odd"),
               'evenCssClass' => Postman4ExcelBehavior::getCssClass("even"),
			],
		];
		// print_r($excel_content);
		// die();
		$excel_file = "Stock Opname";
		$this->export4excel($excel_content, $excel_file,0);
		}else{
			return $this->renderAjax('form_cari_export',[
				'modelPeriode' => $modelPeriode
			]);
		}
	}
}
