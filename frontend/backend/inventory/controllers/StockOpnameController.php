<?php

namespace frontend\backend\inventory\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\data\ArrayDataProvider;
use yii\base\DynamicModel;
use yii\web\Response;
use app\models\UploadForm;
use yii\web\UploadedFile;
use frontend\backend\inventory\models\StockOutSearch;
use frontend\backend\inventory\models\ProductStockClosing;
use frontend\backend\inventory\models\ProductStockClosingSearch;
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
		$paramCari='2018-02-19';
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
		$cari=[
			'TAHUN'=>date('Y', strtotime($paramCari)),
			'BULAN'=>date('m', strtotime($paramCari)),
		
		];	
		
		//DINAMIK MODEL PARAMS
		// $searchModel = new StockOutSearch($cari);
        // $dataProvider = $searchModel->searchOpname(Yii::$app->request->queryParams);
		
		//DINAMIK MODEL PARAMS
		$searchModel = new ProductStockClosingSearch($cari);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
		// print_r($dataProvider->getModels());
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
	public function actionClosingStock($paramcari){

		if (!empty($paramcari)=='1') {
			// print_r($paramcari);die();
			//PUBLIC PARAMS	
			$cari=['thn'=>$paramcari];	
			
			//DINAMIK MODEL PARAMS
			$searchModel = new StockOutSearch($cari);
			$dataProvider = $searchModel->searchOpname(Yii::$app->request->queryParams);
			//LOAD DEFAULT INDEX
			return $this->render('index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
				'paramCari'=>$paramcari
			]);
		} else {
			
			Yii::$app->session->setFlash('error', "Tanggal Belum diinputkan");
			return $this->redirect(['index']);
		}
		
	}
	
	/**====================================
	* DOWNLOAD OPNAME - FORMAT
	* @return mixed
	* @author piter [ptr.nov@gmail.com]
	* @since 1.2
	* ====================================
	*/
	public function actionDownload($paramcari){
		
		if (!empty($paramcari)=='1') {
			//PUBLIC PARAMS	

		$searchModeldownload = new StockOutSearch(['thn'=>$paramcari]);
        $dataProviderdownload = $searchModeldownload->searchOpname(Yii::$app->request->queryParams);
		$dinamikFielddownload=$dataProviderdownload->allModels;
		
		$excel_dataProdukStokdownload = Postman4ExcelBehavior::excelDataFormat($dinamikFielddownload);
        $excel_titleProdukStokdownload = $excel_dataProdukStokdownload['excel_title'];
        $excel_ceilsProdukStokdownload = $excel_dataProdukStokdownload['excel_ceils'];

		
		// print_r($dinamikFielddownload);
		// die();
		//DATA IMPORT
		$excel_contentdownload = [
			[
				'sheet_name' => 'Produk-Stok',
                'sheet_title' => [
					['Nama Toko','Access Group','Produk','Lalu','Masuk','Terjual','Sisa','Closing','Actual']
				],
				'ceils' => $excel_ceilsProdukStokdownload,
				'freezePane' => 'A2',
				'columnGroup'=>false,
				'autoSize'=>false,
				'unlockCell'=>'D,I,'.(count($excel_ceilsProdukStokdownload)+1).'',
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
		$excel_filedownload = "Stock Opname After Closing";
		$this->export4excel($excel_contentdownload, $excel_filedownload,0);
		
		} else {			
			Yii::$app->session->setFlash('error', "Tanggal Belum diinputkan");
			return $this->redirect(['index']);
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
		$modelPeriode = new StockOutSearch;
		 
		if ($modelPeriode->load(Yii::$app->request->post())) {
			$modelPeriode->uploadExport = UploadedFile::getInstance($modelPeriode, 'uploadExport');
			// print_r($fileType);die();	
            if ($modelPeriode->upload()) {			
				$file='uploads/'.$modelPeriode->uploadExport->baseName.'.'.$modelPeriode->uploadExport->extension.'';
				try{
					$FileType = \PHPExcel_IOFactory::identify($file);
					$objReader = \PHPExcel_IOFactory::createReader($FileType);
					$objPHPExcel = $objReader->load($file);
				}catch(Exception $e){
					die('error');
				}
				$sheet = $objPHPExcel->getSheet(0);
				$highestRow = $sheet->getHighestRow();
				$highestColumn=$sheet->getHighestColumn();
				// print_r($highestRow);die();
				for($row = 1; $row <= $highestRow; $row++){
					$rowData = $sheet->rangeToArray('A'.$row.':'.$highestColumn.$row,NULL,TRUE,FALSE);

					// if ($row==1) {
					// 	continue;
					// }

					// $branch = new model;
					// $branch_id = $rowData[0][0];
					// $branch->field_database = $rowData[0][1];
					// $branch->save();

					// print_r($branch->getErrors());
					// print_r($rowData);
				}
				unlink('uploads/'.$modelPeriode->uploadExport->baseName.'.'.$modelPeriode->uploadExport->extension);
				return $this->redirect(['index']);
            }
		}else{
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
		$searchModel = new StockOutSearch(['thn'=>$id."-01"]);
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
				'freezePane' => 'A2',
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
		$excel_file = "Stock Opname Closing fix";
		$this->export4excel($excel_content, $excel_file,0);
		}else{
			return $this->renderAjax('form_cari_export',[
				'modelPeriode' => $modelPeriode
			]);
		}
	}
}
