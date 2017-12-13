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

class PenggajianRekapSearch extends DynamicModel
{
	public $ID;
	public $ACCESS_GROUP;
	public $STORE_ID;
	public $STORE_NM;
	public $NAMA_TOKO;
	public $KARYAWAN;
	public $TOTAL_JAM_TELAT;
	public $TOTAL_JAM_PULANGAWAL;
	public $TOTAL_PERSEN_TELAT;
	public $TOTAL_PERSEN_PULANGAWAL;
	public $TOTAL_RUPIAH_TELAT;
	public $TOTAL_RUPIAH_PULANGAWAL;
	public $TOTAL_JAM_LEMBUR;
	public $TOTAL_PERSEN_LEMBUR;
	public $TOTAL_RUPIAH_LEMBUR;
	public $UPAH_HARIAN;
	public $TOTAL_PEMASUKAN;
	public $TOTAL_POTONGAN;
	public $GRAND_TOTAL;
	

	
	public function rules()
    {
        return [
           [['ID','ACCESS_GROUP','STORE_ID','STORE_NM','KARYAWAN','UPAH_HARIAN'], 'safe'],
           [['TOTAL_JAM_TELAT','TOTAL_JAM_PULANGAWAL','TOTAL_JAM_LEMBUR','TOTAL_JAM_MASUK'], 'safe'],
           [['TOTAL_PERSEN_TELAT','TOTAL_PERSEN_PULANGAWAL','TOTAL_PERSEN_LEMBUR'], 'safe'],
           [['TOTAL_RUPIAH_TELAT','TOTAL_RUPIAH_PULANGAWAL','TOTAL_RUPIAH_LEMBUR'], 'safe'],
           [['TOTAL_PEMASUKAN','TOTAL_POTONGAN','GRAND_TOTAL'], 'safe'],
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
				x1.ID,x1.ACCESS_GROUP,x1.STORE_ID,x2.STORE_NM,x1.KARYAWAN_ID,x1.KARYAWAN,x1.TGL,x1.UPAH_HARIAN,
				x1.TOTAL_JAM_TELAT,x1.TOTAL_JAM_PULANGAWAL,x1.TOTAL_JAM_LEMBUR,x1.TOTAL_JAM_MASUK,x1.TOTAL_PERSEN_TELAT,
				x1.TOTAL_PERSEN_PULANGAWAL,x1.TOTAL_PERSEN_LEMBUR,x1.TOTAL_RUPIAH_TELAT,x1.TOTAL_RUPIAH_PULANGAWAL,
				x1.TOTAL_RUPIAH_LEMBUR,x1.TOTAL_PEMASUKAN,x1.TOTAL_POTONGAN,x1.GRAND_TOTAL
			FROM
			(
				SELECT 
					ID,ACCESS_GROUP,STORE_ID,KARYAWAN_ID,KARYAWAN,TGL,UPAH_HARIAN,
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
					SUM(TTL_POTONGAN) AS TOTAL_POTONGAN,
					(CASE WHEN SUM(TTL_PEMASUKAN) IS NOT NULL OR SUM(TTL_PEMASUKAN)<>'' THEN
					(SUM(TTL_PEMASUKAN)-SUM(TTL_POTONGAN))
					ELSE 0 END)AS GRAND_TOTAL
				FROM hrd_absen_rekap
				WHERE ACCESS_GROUP='".$accessGroup."' AND (TGL BETWEEN '2017-09-23' AND '2017-10-22')
					#AND STORE_ID='170726220936.0001' 
				GROUP BY ACCESS_GROUP,STORE_ID,KARYAWAN_ID
			) x1 left join store x2 on x2.STORE_ID=x1.STORE_ID
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
	
	// private function getGrandTotal(){		
      	// return $this->TOTAL_PEMASUKAN;// - $this->TOTAL_POTONGAN;
	// }
	
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
