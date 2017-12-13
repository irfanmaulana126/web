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

class StockProductController extends Controller
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
	
	/**====================================
	* ACTION INDEX
	* @return mixed
	* @author piter [ptr.nov@gmail.com]
	* @since 1.2
	* ====================================
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
			$paramCari=$hsl['DynamicModel']['TAHUNBULAN']."-01";
		};		
		
		//PUBLIC PARAMS	
		$cari=['thn'=>$paramCari];	
		
		//DINAMIK MODEL PARAMS
		$searchModel = new StockOutSearch($cari);
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
	* EXPORT DATA
	* @return mixed
	* @author piter [ptr.nov@gmail.com]
	* @since 1.2
	* ====================================
	*/
	public function actionExport($id){
		//DINAMIK MODEL PARAMS
		$searchModel = new StockOutSearch(['thn'=>$id]);
        $dataProvider = $searchModel->searchPrint(Yii::$app->request->queryParams);
		$dinamikField=$dataProvider->allModels;
		
		$headerMerge[]=['DATA_PRODUK'=>['font-size'=>'9','align'=>'center','color-font'=>'FFFFFF','color-background'=>'519CC6','merge'=>'1,0','width'=>'15']];
		$headerMerge[]=['DATA_PRODUK1'=>['font-size'=>'9','align'=>'center','color-font'=>'FFFFFF','color-background'=>'519CC6','width'=>'17']];
		$headerMerge[]=['TOTAL_STOK'=>['font-size'=>'9','align'=>'center','color-font'=>'FFFFFF','color-background'=>'519CC6','merge'=>'3,0','width'=>'7']];
		$headerMerge[]=['TOTAL_STOK1'=>['font-size'=>'9','align'=>'center','color-font'=>'FFFFFF','color-background'=>'519CC6','width'=>'7']];
		$headerMerge[]=['TOTAL_STOK2'=>['font-size'=>'9','align'=>'center','color-font'=>'FFFFFF','color-background'=>'519CC6','width'=>'7']];
		$headerMerge[]=['TOTAL_STOK3'=>['font-size'=>'9','align'=>'center','color-font'=>'FFFFFF','color-background'=>'519CC6','width'=>'7']];
			
		$aryFieldColomn[]="NAMA_TOKO";
		$aryFieldColomn[]="PRODUK";
		$aryFieldColomn[]="LALU";
		$aryFieldColomn[]="MASUK";
		$aryFieldColomn[]="TERJUAL";
		$aryFieldColomn[]="SISA";
		$aryFieldColomnHeader[]="DATA_PRODUK";
		$aryFieldColomnHeader[]="DATA_PRODUK1";
		$aryFieldColomnHeader[]="TOTAL_STOK";
		$aryFieldColomnHeader[]="TOTAL_STOK1";
		$aryFieldColomnHeader[]="TOTAL_STOK2";
		$aryFieldColomnHeader[]="TOTAL_STOK3";
		if($dinamikField){
			foreach($dinamikField[0] as $rows => $val){
				//unset($splt);
				//$ambilField[]=$rows; 		
				$splt=explode('_',$rows);
				if($splt[0]=='IN'){
					//sheet_title-row1
					$aryFieldColomnHeader[]=$splt[1];
					//headerStyle-row1
					$headerMerge[]=[$splt[1]=>['font-size'=>'9','align'=>'center','color-font'=>'FFFFFF','color-background'=>'519CC6','merge'=>'2,0','width'=>'7']];				
					//sheet_title-row2
					$aryFieldColomn[]='Masuk';
					$columnMerge[]=['Closing'=>['font-size'=>'9','align'=>'center','color-font'=>'FFFFFF','color-background'=>'519CC6','merge'=>'1,0','width'=>'7']];
			
				}
				if($splt[0]=='OUT'){
					//sheet_title-row2
					$aryFieldColomn[]='Keluar';
					//sheet_title-row1
					$aryFieldColomnHeader[]=$rows;
					//headerStyle-row1
					$headerMerge[]=[$rows=>['font-size'=>'9','align'=>'center','color-font'=>'FFFFFF','color-background'=>'519CC6','width'=>'7']];
				}
				if($splt[0]=='SISA'){
					//sheet_title-row2
					$aryFieldColomn[]='Sisa';
					//sheet_title-row1
					$aryFieldColomnHeader[]=$rows;
					//headerStyle-row1
					$headerMerge[]=[$rows=>['font-size'=>'9','align'=>'center','color-font'=>'FFFFFF','color-background'=>'519CC6','width'=>'7']];
				};
			};
			//sheet_title-row1
			$aryFieldColomnHeader[]='STOK_OPNAME'; 
			$aryFieldColomnHeader[]='STOK OPNAME1';
			
			//headerStyle-row1
			$headerMerge[]=['STOK_OPNAME'=>['font-size'=>'9','align'=>'center','color-font'=>'FFFFFF','color-background'=>'519CC6','merge'=>'1,0','width'=>'7']];
			
			//sheet_title-row2
			$aryFieldColomn[]="Closing";
			$aryFieldColomn[]="Actual";
			
			//headerStyle-row2
			$columnMerge[]=['Closing'=>['font-size'=>'9','align'=>'center','color-font'=>'FFFFFF','color-background'=>'519CC6','merge'=>'1,0','width'=>'7']];
			$columnMerge[]=['Actual'=>['font-size'=>'9','align'=>'center','color-font'=>'FFFFFF','color-background'=>'519CC6','merge'=>'1,0','width'=>'7']];
			
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

		
		//DATA IMPORT
		$excel_content = [
			[
				'sheet_name' => 'Produk-Stok',
                'sheet_title' => [
					$aryFieldColomnHeader,
					$aryFieldColomn
				],
			    'ceils' => $excel_ceilsProdukStok,
                //'freezePane' => 'A3',
                'headerColor' => Postman4ExcelBehavior::getCssClass("header"),
                'headerStyle'=>[	
					$setHeaderMerge,
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
				],
               'oddCssClass' => Postman4ExcelBehavior::getCssClass("odd"),
               'evenCssClass' => Postman4ExcelBehavior::getCssClass("even"),
			],
		];
		// print_r($excel_content);
		// die();
		$excel_file = "ProdukStock";
		$this->export4excel($excel_content, $excel_file,1);
	}
	
}
