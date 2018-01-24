<?php
namespace frontend\backend\dashboard\controllers;

use yii;
use yii\helpers\Json;
//use yii\rest\ActiveController;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\QueryParamAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\ContentNegotiator;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\ArrayHelper;
use yii\web\HttpException;


use frontend\backend\laporan\models\RptDailyChart;
use frontend\backend\laporan\models\RptDailyChartSearch;
use frontend\backend\dashboard\models\TransPenjualanHeaderSummaryDailyHourSearch;
use frontend\backend\dashboard\models\TransPenjualanHeaderSummaryMonthly;
use frontend\backend\dashboard\models\ChartWeeklySales;
use frontend\backend\dashboard\models\ChartMonthlySales;
/**
 * FoodtownController implements the CRUD actions for Foodtown model.
 */
class DataController extends Controller
{
	 public function behaviors()    {
        return ArrayHelper::merge(parent::behaviors(), [
			'bootstrap'=> 
            [
				'class' => ContentNegotiator::className(),
				'formats' => 
                [
					'application/json' => Response::FORMAT_JSON,"JSON_PRETTY_PRINT"
				],
				
			],
			'corsFilter' => [
				'class' => \yii\filters\Cors::className(),
				'cors' => [
					// restrict access to
					'Origin' => ['*','http://localhost:810'],
					'Access-Control-Request-Method' => ['POST', 'PUT','GET'],
					// Allow only POST and PUT methods
					'Access-Control-Request-Headers' => ['X-Wsse'],
					// Allow only headers 'X-Wsse'
					'Access-Control-Allow-Credentials' => true,
					// Allow OPTIONS caching
					'Access-Control-Max-Age' => 3600,
					// Allow the X-Pagination-Current-Page header to be exposed to the browser.
					'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page'],
				]		
			],
			/* 'corsFilter' => [
				'class' => \yii\filters\Cors::className(),
				'cors' => [
					'Origin' => ['*'],
					'Access-Control-Allow-Headers' => ['X-Requested-With','Content-Type'],
					'Access-Control-Request-Method' => ['POST', 'GET', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
					//'Access-Control-Request-Headers' => ['*'],					
					'Access-Control-Allow-Credentials' => true,
					'Access-Control-Max-Age' => 3600,
					'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page']
					]		 
			], */
        ]);		
    }  
    
    
    public function actionDailyTransaksi()
    {
		$tglWaktu='';
	   $model=RptDailyChart::find()->where(['ACCESS_GROUP'=>Yii::$app->getUserOpt->user(),'Val_Nm'=>'TRANSAKSI_HARIAN'])->one();
	   $searchModel = new TransPenjualanHeaderSummaryDailyHourSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
		$modelHour=$dataProvider->getModels();
		//$i=0;
		foreach ($modelHour as $row => $val){
			//$i=0;
			$dataval='';
			for( $i= 1 ; $i <= 24 ; $i++ ) {
				$dataval[]=['label'=>$i,'value'=>$val['VAL'.$i],'anchorBgColor'=>'#00fd83'];
			}
			$rslt['seriesname']=$val['storeNm'];
			$rslt['data']=$dataval;	
			$rsltDataSet[]=$rslt;	
			$tglWaktu=$val['UPDATE_AT'];
		};
		
       $data['chart']='
		"chart":{"caption": " HARIAN TRANSAKSI ",
				"subCaption": "'.$tglWaktu.'",
				"captionFontSize": "12",
				"subcaptionFontSize": "10",
				"subcaptionFontBold": "0",
				"paletteColors": "#0B1234,#68acff,#00fd83,#e700c4,#8900ff,#fb0909,#0000ff,#ff4040,#7fff00,#ff7f24,#ff7256,#ffb90f,#006400,#030303,#ff69b4,#8b814c,#3f6b52,#744f4f,#6fae93,#858006,#426506,#055c5a,#a7630d,#4d8a9c,#449f9c,#8da9ab,#c4dfdd,#bf7793,#559e96,#afca84,#608e97,#806d88,#688b94,#b5dfe7,#b29cba,#83adb5,#c7bbc9,#2d5867,#e1e9b7,#bcd2d0,#f96161,#c9bbbb,#bfc5ce,#8f6d4d,#a87f99,#62909b,#a0acc0,#94b9b8",
				"bgcolor": "#ffffff",
				"showBorder": "0",
				"showShadow": "0",
				"usePlotGradientColor": "0",
				"legendBorderAlpha": "0",
				"legendShadow": "0",
				"showAxisLines": "1",
				"showAlternateHGridColor": "0",
				"divlineThickness": "1",
				"divLineIsDashed": "0",
				"divLineDashLen": "1",
				"divLineGapLen": "1",
				"vDivLineDashed": "0",
				"numVDivLines": "6",
				"vDivLineThickness": "1",
				"xAxisName": "24 Hour",
				"yAxisName": "Jumlah Transaction",
				"anchorradius": "3",
				"plotHighlightEffect": "fadeout|color=#f6f5fd, alpha=60",
				"showValues": "0",
				"rotateValues": "0",
				"placeValuesInside": "0",
				"formatNumberScale": "0",
				"decimalSeparator": ",",
				"thousandSeparator": ".",
				"numberPrefix": "",
				"ValuePadding": "0",
				"yAxisValuesStep": "1",
				"xAxisValuesStep": "0",
				"yAxisMinValue": "0",
				"numDivLines": "10",
				"xAxisNamePadding": "30",
				"showHoverEffect": "1",
				"animation": "1"
			}';
		 $data['categories']='
			"categories":[
				{
					"category":[
						{
							"label": "01"
						},
						{
							"label": "02"
						},
						{
							"label": "03"
						},
						{
							"label": "04"
						},
						{
							"label": "05"
						},
						{
							"label": "06"
						},
						{
							"label": "07"
						},
						{
							"label": "08"
						},
						{
							"label": "09"
						},
						{
							"label": "10"
						},
						{
							"label": "11"
						},
						{
							"label": "12"
						},
						{
							"label": "13"
						},
						{
							"label": "14"
						},
						{
							"label": "15"
						},
						{
							"label": "16"
						},
						{
							"label": "17"
						},
						{
							"label": "18"
						},
						{
							"label": "19"
						},
						{
							"label": "20"
						},
						{
							"label": "21"
						},
						{
							"label": "22"
						},
						{
							"label": "23"
						},
						{
							"label": "24"
						}						
					]
				}
			]';
		
		$data['dataset']='
			"dataset":[
					{
						"seriesname": "TOKO A",
						"data": null
					},
					{
						"seriesname": "TOKO B",
						"data": [
							{
								"label": "10",
								"value": "54",
								"anchorBgColor": "#68acff"
							},
							{
								"label": "11",
								"value": "46",
								"anchorBgColor": "#68acff"
							}
						]
					},
					{
						"seriesname": "TOKO C",
						"data": [
							{
								"label": "10",
								"value": "15",
								"anchorBgColor": "#00fd83"
							},
							{
								"label": "11",
								"value": "59",
								"anchorBgColor": "#00fd83"
							}
						]
					}
				]';
				
		/* ===================
		 * == FROM DATABASE ==
		 * ===================*/	
		//return json::decode("{".$data['chart'].','.$data['categories'].','.$data['dataset']."}");
		// $rsltDataSet='"dataset":'.Yii::$app->arrayBantuan->strJson($model->Val_Json);		
		//return json::decode("{".$data['chart'].','.$data['categories'].','.$rsltDataSet."}");		
		$dataset='"dataset":'.json::encode($rsltDataSet);
		return json::decode("{".$data['chart'].','.$data['categories'].','.$dataset."}");
		// return $rsltDataSet;
	  }
		
	/**
	 * ===================================
	 * ========== WEEKLY SALES ===========
	 * ===================================
	 * Line Chart 
	 * Type 		: msline
	 * create by	: ptr.nov@gmail.com	
	 * ===================================
	*/
	public function actionWeeklySales(){
		$params     		= $_REQUEST;
		$paramsHeader		= Yii::$app->request->headers;
		$paramAccessGroup	= isset($params['ACCESS_GROUP'])!=''?$params['ACCESS_GROUP']:$paramsHeader['ACCESS_GROUP'];
		$paramTahun			= isset($params['TAHUN'])!=''?$params['TAHUN']:$paramsHeader['TAHUN'];
		$paramBulan			= isset($params['BULAN'])!=''?$params['BULAN']:$paramsHeader['BULAN'];
		
		$modelWeeklySales= new ChartWeeklySales([
			'ACCESS_GROUP'=>$paramAccessGroup,		//'170726220936'
			'TAHUN'=>$paramTahun,					//'2018',
			'BULAN'=>$paramBulan					//'1'
		]);
		return $modelWeeklySales;
	}	
	
	/**
	 * ===================================
	 * ========== MONTHLY SALES ==========
	 * ===================================
	 * Line Chart 
	 * Type 		: msline
	 * create by	: ptr.nov@gmail.com	
	 * ===================================
	*/
	public function actionMonthySales()
    {
		$params     		= $_REQUEST;
		$paramsHeader		= Yii::$app->request->headers;
		$paramAccessGroup	= isset($params['ACCESS_GROUP'])!=''?$params['ACCESS_GROUP']:$paramsHeader['ACCESS_GROUP'];
		$paramTahun			= isset($params['TAHUN'])!=''?$params['TAHUN']:$paramsHeader['TAHUN'];
		$paramBulan			= isset($params['BULAN'])!=''?$params['BULAN']:$paramsHeader['BULAN'];
		
		$modelMonthlySales= new ChartMonthlySales([
			'ACCESS_GROUP'=>$paramAccessGroup,		//'170726220936'
			'TAHUN'=>$paramTahun,					//'2018',
			'BULAN'=>$paramBulan					//'1'
		]);
		return $modelMonthlySales;		
	}
	
	public function actionTest()
    {
		$params     		= $_REQUEST;
		$paramsHeader		= Yii::$app->request->headers;
		$paramAccessGroup	= isset($params['ACCESS_GROUP'])!=''?$params['ACCESS_GROUP']:$paramsHeader['ACCESS_GROUP'];
		$paramTahun			= isset($params['TAHUN'])!=''?$params['TAHUN']:$paramsHeader['TAHUN'];
		$paramBulan			= isset($params['BULAN'])!=''?$params['BULAN']:$paramsHeader['BULAN'];
		
		$modelMonthlySales= new ChartMonthlySales([
			'ACCESS_GROUP'=>$paramAccessGroup,		//'170726220936'
			'TAHUN'=>$paramTahun,					//'2018',
			'BULAN'=>$paramBulan					//'1'
		]);
		return $modelMonthlySales;		
	}
	
	
	
	function weekOfMonthMysql($date) {
		$minggu= date('W', strtotime($date));
		if ($minggu<>0){
			return ($minggu)-1;
		} else{
			return $minggu;
		}
	}
}