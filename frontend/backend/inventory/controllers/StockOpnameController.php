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
	public function actionExport($id){
		return true;
	}
}
