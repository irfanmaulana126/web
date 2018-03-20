<?php

namespace frontend\backend\laporan\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Response;
use yii\data\ArrayDataProvider;
use yii\base\Model;
use \yii\base\DynamicModel;
use yii\debug\components\search\Filter;
use yii\debug\components\search\matchers;
use api\modules\laporan\models\Store;

class LaporanArusKas extends Model
{	

	// public $ACCESS_GROUP;
	// public $STORE_ID;
	public $TAHUN;
	public $BULAN;
	//public $BLN;
    /**
     * @inheritdoc	
     */
    public function rules()
    {
        return [
            [['KREDIT','KREDIT','TAHUN','BULAN'], 'safe'],
        ];
    }

	public function searchArusKeuangan($params){
		$sql="				
			#SET @bln='1';
			#SET @thn='2018';
			SELECT  
				jtd.RPT_DETAIL_ID,RPT_SORTING,jtd.RPT_GROUP_ID,jtd.RPT_GROUP_NM,
				jtd.RPT_TITLE_ID,jtd.RPT_TITLE_NM,jtd.CAL_FORMULA,jtd.CAL_FORMULA_NM,
				jtd.STATUS,jtd.STATUS_NM,
				jtd.AKUN_CODE,jtd.AKUN_NM,jtd.KTG_CODE,jtd.KTG_NM,
				'2' AS BULAN,'2018' AS TAHUN,
				(CASE WHEN JUMLAH is not null THEN JUMLAH ELSE 0 END) AS JUMLAH,
				(CASE WHEN CAL_FORMULA=1 OR CAL_FORMULA=3 THEN
					 (CASE WHEN JUMLAH is not null THEN JUMLAH ELSE 0 END)
				ELSE 0 END) AS DEBET,
				(CASE WHEN CAL_FORMULA=0 OR CAL_FORMULA=3 THEN
					 (CASE WHEN JUMLAH is not null THEN JUMLAH ELSE 0 END)
				ELSE 0 END) AS KREDIT
			FROM jurnal_template_detail jtd 
			LEFT JOIN jurnal_transaksi_c jc
				ON jc.AKUN_CODE=jtd.AKUN_CODE AND
				jc.TAHUN='2018' AND 
				jc.BULAN='".$this->BULAN."' AND
				jc.ACCESS_GROUP='170726220936'
			WHERE jtd.RPT_GROUP_ID=1
		";		
		$qrySql= Yii::$app->production_api->createCommand($sql)->queryAll(); 		
		$dataProvider= new ArrayDataProvider([	
			'allModels'=>$qrySql,	
			'pagination' => [
				'pageSize' =>10000,
			],			
		]);
			
		$this->load($params);
		
		if (!($this->load($params) && $this->validate())) {
 			return $dataProvider;
 		}
		
		// $filter = new Filter();
 		// $this->addCondition($filter, 'TerminalID', true);
 		// $this->addCondition($filter, 'EMP_NM', true);	
 		//$dataProvider->allModels = $filter->filter($qrySql);
		
		return $dataProvider;
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
