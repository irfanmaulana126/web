<?php

namespace frontend\backend\hris\models;

use Yii;
use yii\base\Model;
use yii\base\DynamicModel;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Response;
use yii\data\ArrayDataProvider;
use yii\debug\components\search\Filter;
use yii\debug\components\search\matchers;

class PayrollRekapSearch extends DynamicModel
{
	public $ACCESS_GROUP;
	public $STORE_ID;
	public $STORE_NM;
	public $NAMA_TOKO;
	public $TAHUN;
	public $BULAN;
	public $PRODUCT_ID;
	public $PRODUCT_NM;
	public $QTY;

	
	public function rules()
    {
        return [
           [['ACCESS_GROUP','STORE_ID','STORE_NM','NAMA_TOKO','TAHUN', 'BULAN','PRODUCT_ID','PRODUCT_NM','QTY','thn'], 'safe'],
		];	

    }	
		
	//WHERE a.MONTH_AT='".date("Y-m-d", strtotime($this->BULAN))."' AND a.ACCESS_GROUP='".$this->ACCESS_GROUP."' AND a.STORE_ID='".$this->STORE_ID."'
	 //$query = TransPenjualanDetail::find()->where(['ACCESS_GROUP'=>Yii::$app->getUserOpt->user()['ACCESS_GROUP']]);
	public function search($params){
		
      	$accessGroup=Yii::$app->getUserOpt->user()['ACCESS_GROUP'];//'170726220936';
		// $TGL=$this->thn!=''?$this->thn:date('Y-m-d');
		 $TGL='2017-10-30';
		 $sqlStr="
			SELECT 
				ACCESS_GROUP,STORE_ID,KARYAWAN_ID,KARYAWAN,TGL,
				SEC_TO_TIME(SUM( TIME_TO_SEC(SELISIH_TELAT))) AS TOTAL_JAM_TELAT,  
				SEC_TO_TIME(SUM( TIME_TO_SEC(SELISIH_AWALPULANG))) AS TOTAL_JAM_PULANGAWAL, 
				SEC_TO_TIME(SUM( TIME_TO_SEC(KELEBIHAN_WAKTU))) AS TOTAL_JAM_LEMBUR,
				SEC_TO_TIME(SUM( TIME_TO_SEC(TTL_MASUK))) AS TOTAL_JAM_MASUK,
				SUM(POT_PERSEN_TELAT) AS TOTAL_PERSEN_TELAT,
				SUM(POT_PERSEN_PULANG) AS TOTAL_PERSEN_PULANGAWAL,
				SUM(LEMBUR_PERSEN) AS TOTAL_PERSEN_LEMBUR,
				SUM(POT_RUPIAH_TELAT) AS TOTAL_RUPIAH_TELAT,
				SUM(POT_RUPIAH_PULANG) AS TOTAL_RUPIAH_PULANGAWAL,
				SUM(LEMBUR_RUPIAH) AS TOTAL_RUPIAH_LEMBUR,
				SUM(TTL_PEMASUKAN) AS TOTAL_PEMASUKAN,
				SUM(TTL_POTONGAN) AS TOTAL_POTONGAN
			FROM hrd_absen_rekap
			WHERE ACCESS_GROUP='".$accessGroup."' AND (TGL BETWEEN '2017-09-23' AND '2017-10-22')
				#AND STORE_ID='170726220936.0001' 
			GROUP BY ACCESS_GROUP,STORE_ID,KARYAWAN_ID	
		 ";
			
		$qrySql= Yii::$app->production_api->createCommand($sqlStr)->queryAll(); 	
		$dataProvider= new ArrayDataProvider([	
			'allModels'=>$qrySql,	
			'pagination' => [
				'pageSize' =>10000,
			],			
		]);
		
		if (!($this->load($params) && $this->validate())) {
 			return $dataProvider;
 		}
		
		$filter = new Filter();
 		$this->addCondition($filter, 'ACCESS_GROUP', true);	
		$this->addCondition($filter, 'STORE_ID', true);	
		$this->addCondition($filter, 'STORE_NM', true);	
		$dataProvider->allModels = $filter->filter($qrySql);
        return $dataProvider;
    }
	
	public function searchPrint($params){
		
      	$accessGroup=Yii::$app->getUserOpt->user()['ACCESS_GROUP'];//'170726220936';
		$TGL=$this->thn!=''?$this->thn:date('Y-m-d');
		
	}
	
	
	public function addCondition(Filter $filter, $attribute, $partial = false)
    {
        $value = $this->$attribute;

        if (mb_strpos($value, '>') !== false) {
            $value = intval(str_replace('>', '', $value));
            $filter->addMatcher($attribute, new matchers\GreaterThan(['value' => $value]));

        } elseif (mb_strpos($value, '<') !== false) {
            $value = intval(str_replace('<', '', $value));
            $filter->addMatcher($attribute, new matchers\LowerThan(['value' => $value]));
        } else {
            $filter->addMatcher($attribute, new matchers\SameAs(['value' => $value, 'partial' => $partial]));
        }
    }
}
