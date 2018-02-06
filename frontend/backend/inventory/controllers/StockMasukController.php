<?php

namespace frontend\backend\inventory\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\data\ArrayDataProvider;
use yii\base\DynamicModel;
use yii\web\Response;
use frontend\backend\inventory\models\StockMasukSearch;
use ptrnov\postman4excel\Postman4ExcelBehavior;

class StockMasukController extends Controller
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
		$searchModel = new StockMasukSearch($cari);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
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
	* CARD STOCK
	* @return mixed
	* @author piter [ptr.nov@gmail.com]
	* @since 1.2
	* ====================================
	*/
	public function actionCardStock(){
		$modelPeriode = new \yii\base\DynamicModel([
			'TAHUNBULAN','TAHUN','BULAN'
		]);		
		$modelPeriode->addRule(['TAHUNBULAN'], 'required')
         ->addRule(['TAHUNBULAN','TAHUN','BULAN'], 'safe');
		 
		if (!$modelPeriode->load(Yii::$app->request->post())) {
			return $this->renderAjax('form_card',[
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
			'TAHUNBULAN','TAHUN','BULAN'
		]);		
		$modelPeriode->addRule(['TAHUNBULAN'], 'required')
         ->addRule(['TAHUNBULAN','TAHUN','BULAN'], 'safe');
		
		 if ($modelPeriode->load(Yii::$app->request->post())) {
			$hsl = \Yii::$app->request->post();	
			$paramCari=$hsl['DynamicModel']['TAHUNBULAN']."-01";
			//PUBLIC PARAMS	
			$cari=['thn'=>$paramCari];	
			
			//DINAMIK MODEL PARAMS
			$searchModel = new StockMasukSearch($cari);
			$dataProvider = $searchModel->searchExport(Yii::$app->request->queryParams);
			//LOAD DEFAULT INDEX
			$dinamikField=$dataProvider->allModels;
		
		$headerMerge[]=['DATA_PRODUK'=>['font-size'=>'1','align'=>'center','color-font'=>'FFFFFF','color-background'=>'519CC6','merge'=>'1,0','width'=>'15']];
		$headerMerge[]=['DATA_PRODUK1'=>['font-size'=>'1','align'=>'center','color-font'=>'FFFFFF','color-background'=>'519CC6','width'=>'17']];
		
		$aryFieldColomn[]="NAMA_TOKO";
		$aryFieldColomn[]="NAMA PRODUK";
		$aryFieldColomnHeader[]="DATA_PRODUK";
		$aryFieldColomnHeader[]="DATA_PRODUK1";	

		if($dinamikField){
			foreach($dinamikField[0] as $rows => $val){
				//unset($splt);
				//$ambilField[]=$rows; 		
				$splt=explode('_',$rows);
				if($splt[0]=='IN'){
					//sheet_title-row1
					$aryFieldColomnHeader[]=$splt[1];
					//headerStyle-row1
					$headerMerge[]=[$splt[1]=>['font-size'=>'1','align'=>'center','color-font'=>'FFFFFF','color-background'=>'519CC6','merge'=>'2,0','width'=>'7']];				
					//sheet_title-row2
					$aryFieldColomn[]='QTY MASUK';
				};
			};
		 } 	
		$setHeaderMerge=[];
		foreach($headerMerge as $key=>$val){
			$setHeaderMerge=array_merge($setHeaderMerge,$headerMerge[$key]);			
		}	
		// print_r($setHeaderMerge);
		// die();
		
		$excel_dataProdukStok = Postman4ExcelBehavior::excelDataFormat($dinamikField);
        $excel_titleProdukStok = $excel_dataProdukStok['excel_title'];
        $excel_ceilsProdukStok = $excel_dataProdukStok['excel_ceils'];
		
		// print_r($setHeaderMerge);
		// die();
		//DATA IMPORT
		$excel_content = [
			[
				'sheet_name' => 'Produk-Stok-Masuk',
                'sheet_title' => [
					$aryFieldColomnHeader,
					$aryFieldColomn,
				],
			    'ceils' => $excel_ceilsProdukStok,
				'freezePane' => 'A3',
				'autoSize'=>false,
				'columnGroup'=>false,
				'headerColor' => Postman4ExcelBehavior::getCssClass("header"),
				// 'headerStyle'=>$setHeaderMerge,
				// 'contentStyle'=>$setHeaderMerge,
               'oddCssClass' => Postman4ExcelBehavior::getCssClass("odd"),
               'evenCssClass' => Postman4ExcelBehavior::getCssClass("even"),
			],
		];
		$excel_file = "ProdukStockMasuk";
		$this->export4excel($excel_content, $excel_file,0);
		}else {
			return $this->renderAjax('form_cari_export',[
				'modelPeriode' => $modelPeriode
			]);	
		}				
		
	}
}
