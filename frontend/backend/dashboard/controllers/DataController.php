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
// use frontend\backend\dashboard\models\TransPenjualanHeaderSummaryDailyHourSearch;
// use frontend\backend\dashboard\models\TransPenjualanHeaderSummaryMonthly;
use frontend\backend\dashboard\models\ChartWeeklySales;
use frontend\backend\dashboard\models\ChartMonthlySales;
use frontend\backend\dashboard\models\ChartDayHourSales;
use frontend\backend\dashboard\models\MonthlySales;
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
    
    /**
	 * ===================================
	 * ========== DAILY HOUR   ===========
	 * ===================================
	 * Line Chart 
	 * Type 		: msline
	 * create by	: ptr.nov@gmail.com	
	 * ===================================
	*/
    public function actionDailyTransaksi()
    {
		$params     		= $_REQUEST;
		//$paramsHeader		= Yii::$app->request->headers;
		$paramAccessGroup	= isset($params['ACCESS_GROUP'])?$params['ACCESS_GROUP']:'';
		$paramTGL			= isset($params['TGL'])?$params['TGL']:'';
		
		$modelDayHourCount= new ChartDayHourSales([
			'ACCESS_GROUP'=>$paramAccessGroup,				//'170726220936'
			'TGL'=>$paramTGL,		//'1'
		]);
		return $modelDayHourCount;		
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
		//$paramsHeader		= Yii::$app->request->headers;
		$paramAccessGroup	= isset($params['ACCESS_GROUP'])!=''?$params['ACCESS_GROUP']:'';//$paramsHeader['ACCESS_GROUP'];
		$paramTahun			= isset($params['TAHUN'])?$params['TAHUN']:'';//$paramsHeader['TAHUN'];
		$paramBulan			= isset($params['BULAN'])?$params['BULAN']:'';//$paramsHeader['BULAN'];
		
		$modelWeeklySales= new ChartWeeklySales([
			'ACCESS_GROUP'=>$paramAccessGroup,		//'170726220936'
			'TAHUN'=>$paramTahun,					//'2018',
			'BULAN'=>$paramBulan,					//'1'
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
		//$paramsHeader		= Yii::$app->request->headers;
		$paramAccessGroup	= isset($params['ACCESS_GROUP'])!=''?$params['ACCESS_GROUP']:'';//$paramsHeader['ACCESS_GROUP'];
		$paramTahun			= isset($params['TAHUN'])?$params['TAHUN']:'';//$paramsHeader['TAHUN'];
		$paramBulan			= isset($params['BULAN'])?$params['BULAN']:'';//$paramsHeader['BULAN'];
		
		$modelMonthlySales= new ChartMonthlySales([
			'ACCESS_GROUP'=>$paramAccessGroup,		//'170726220936'
			'TAHUN'=>$paramTahun,					//'2018',
			'BULAN'=>$paramBulan					//'1'
		]);
		return $modelMonthlySales;		
	}
	
	public function actionTest()
    {
		/* $params     		= $_REQUEST;
		//$paramsHeader		= Yii::$app->request->headers;
		$paramAccessGroup	= isset($params['ACCESS_GROUP'])!=''?$params['ACCESS_GROUP']:'';//$paramsHeader['ACCESS_GROUP'];
		$paramTahun			= isset($params['TAHUN'])!=''?$params['TAHUN']:'';//$paramsHeader['TAHUN'];
		$paramBulan			= isset($params['BULAN'])!=''?$params['BULAN']:'';//$paramsHeader['BULAN'];
		$paramTGL			= isset($params['TGL'])!=''?$params['TGL']:'';//$paramsHeader['TGL'];
		
		$modelDayHourCount= new ChartDayHourSales([
			'ACCESS_GROUP'=>$paramAccessGroup,		//'170726220936'
			'TAHUN'=>$paramTahun,					//'2018',
			'BULAN'=>$paramBulan,					//'1'
			'TGL'=>$paramTGL						//'1'
		]); */
		//return $modelDayHourCount;		
		//return self::weekOfMonthMysql('2018-02-02');	
		// return str_pad(10, 2, '0', STR_PAD_LEFT);	
       return MonthlySales::find()->all();		
	}
	
	
	
	function weekOfMonthMysql($date) {
		$minggu= date('W', strtotime($date));
		if ($minggu<>0){
			return ($minggu)-1;
		} else{
			return $minggu;
		}
	}
	/* public function beforeAction($action){
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
   } */
}