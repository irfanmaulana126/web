<?php

namespace frontend\backend\inventory\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Response;
use yii\data\ArrayDataProvider;
use yii\debug\components\search\Filter;
use yii\debug\components\search\matchers;

class StockOutSearch extends \yii\base\DynamicModel
{
	public $TAHUN;
	public $BULAN;
	public $ACCESS_GROUP;
	public $STORE_ID;
	public $KARYAWAN_ID;
	public $KARYAWAN;
	public $TGL;
	public $MASUK;
	public $KELUAR;
	public $LONGITUDE;
	public $LATITUDE;
	
	public function rules()
    {
        return [
           // [['TAHUN', 'BULAN', 'ACCESS_GROUP','STORE_ID','KARYAWAN_ID','KARYAWAN','TGL','MASUK','KELUAR','LONGITUDE','LATITUDE'], 'safe'],
            [['TGL_RUN'], 'safe'],
		];	

    }	
		
	//WHERE a.MONTH_AT='".date("Y-m-d", strtotime($this->BULAN))."' AND a.ACCESS_GROUP='".$this->ACCESS_GROUP."' AND a.STORE_ID='".$this->STORE_ID."'
	public function search($params){
		
		$sql="
			SET SESSION GROUP_CONCAT_MAX_LEN = 1000000;
			SELECT				
				GROUP_CONCAT(DISTINCT
					CONCAT(
						\"MAX(CASE WHEN DATE_FORMAT(inv.TGL,'%Y-%m-%d') = '\",
						DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),
						\"' THEN inv.PRODUCT_QTY ELSE 0 END) AS 'QTY_\",DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),\"'\"												
					)
				) into @fildText
			FROM	
			(
				SELECT a.Date as TGL_RUN
				FROM (
					select '2017-11-09' - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY as Date
					from (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) as a
					cross join (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) as b
					cross join (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) as c
				) a
				WHERE a.Date BETWEEN  '2017-11-01' AND '2017-11-09' ORDER BY a.Date ASC
			)str1 ORDER BY str1.TGL_RUN ASC limit 1;

			SET @sqlRslt = CONCAT(\"
				SELECT inv.ACCESS_GROUP,inv.STORE_ID,inv.TAHUN,inv.BULAN,inv.PRODUCT_ID,inv.PRODUCT_NM,\",@fildText,\"
				FROM
				(SELECT
						(CASE WHEN x1.ACCESS_GROUP<>'' THEN x1.ACCESS_GROUP ELSE x2.ACCESS_GROUP END) AS  ACCESS_GROUP,
						(CASE WHEN x1.STORE_ID<>'' THEN x1.STORE_ID ELSE x2.STORE_ID END) AS  STORE_ID,
						(CASE WHEN x1.TAHUN<>'' THEN x1.TAHUN ELSE x1.TAHUN END) AS  TAHUN,
						(CASE WHEN x1.BULAN<>'' THEN x1.BULAN ELSE x1.BULAN END) AS  BULAN,
						(CASE WHEN x1.TGL<>'' THEN x1.TGL ELSE x1.TGL END) AS  TGL,
						(CASE WHEN x1.PRODUCT_ID<>'' THEN x1.PRODUCT_ID ELSE x2.PRODUCT_ID END) AS  PRODUCT_ID,
						(CASE WHEN x1.PRODUCT_NM<>'' THEN x1.PRODUCT_NM ELSE x2.PRODUCT_NM END) AS  PRODUCT_NM,
						(CASE WHEN x1.PRODUCT_QTY<>'' THEN x1.PRODUCT_QTY ELSE '0' END) AS  PRODUCT_QTY
					FROM
					(
						SELECT ACCESS_GROUP,STORE_ID,TAHUN,BULAN,TGL,PRODUCT_ID,PRODUCT_NM,PRODUCT_QTY
						FROM trans_penjualan_detail_summary_daily
						WHERE ACCESS_GROUP='170726220936' AND STORE_ID='170726220936.0001' AND TGL BETWEEN @tglStart AND @tglEnd
					)x1 RIGHT JOIN
					( 
						SELECT ACCESS_GROUP,STORE_ID,PRODUCT_ID,PRODUCT_NM
						FROM product 
						WHERE	ACCESS_GROUP='170726220936' AND STORE_ID='170726220936.0001'	
					)x2 on x2.PRODUCT_ID=x1.PRODUCT_ID
				) inv
				GROUP BY inv.PRODUCT_ID,inv.BULAN
				ORDER BY inv.PRODUCT_ID,inv.TGL
		\");
   
	
		";		
		Yii::$app->production_api->createCommand($sql)->execute();		
		$qrySql= Yii::$app->production_api->createCommand("
			#SELECT @sqlRslt; 
			PREPARE stmt FROM @sqlRslt; 
			EXECUTE stmt;
			DEALLOCATE PREPARE stmt;
		")->queryAll();
		$qrySql1= Yii::$app->production_api->createCommand("
			#select @fildText;
				SELECT inv.ACCESS_GROUP,inv.STORE_ID,inv.TAHUN,inv.BULAN,inv.PRODUCT_ID,inv.PRODUCT_NM,@fildText
				FROM
				(SELECT
						(CASE WHEN x1.ACCESS_GROUP<>'' THEN x1.ACCESS_GROUP ELSE x2.ACCESS_GROUP END) AS  ACCESS_GROUP,
						(CASE WHEN x1.STORE_ID<>'' THEN x1.STORE_ID ELSE x2.STORE_ID END) AS  STORE_ID,
						(CASE WHEN x1.TAHUN<>'' THEN x1.TAHUN ELSE x1.TAHUN END) AS  TAHUN,
						(CASE WHEN x1.BULAN<>'' THEN x1.BULAN ELSE x1.BULAN END) AS  BULAN,
						(CASE WHEN x1.TGL<>'' THEN x1.TGL ELSE x1.TGL END) AS  TGL,
						(CASE WHEN x1.PRODUCT_ID<>'' THEN x1.PRODUCT_ID ELSE x2.PRODUCT_ID END) AS  PRODUCT_ID,
						(CASE WHEN x1.PRODUCT_NM<>'' THEN x1.PRODUCT_NM ELSE x2.PRODUCT_NM END) AS  PRODUCT_NM,
						(CASE WHEN x1.PRODUCT_QTY<>'' THEN x1.PRODUCT_QTY ELSE '0' END) AS  PRODUCT_QTY
					FROM
					(
						SELECT ACCESS_GROUP,STORE_ID,TAHUN,BULAN,TGL,PRODUCT_ID,PRODUCT_NM,PRODUCT_QTY
						FROM trans_penjualan_detail_summary_daily
						WHERE ACCESS_GROUP='170726220936' AND STORE_ID='170726220936.0001' AND TGL BETWEEN @tglStart AND @tglEnd
					)x1 RIGHT JOIN
					( 
						SELECT ACCESS_GROUP,STORE_ID,PRODUCT_ID,PRODUCT_NM
						FROM product 
						WHERE	ACCESS_GROUP='170726220936' AND STORE_ID='170726220936.0001'	
					)x2 on x2.PRODUCT_ID=x1.PRODUCT_ID
				) inv
				GROUP BY inv.PRODUCT_ID,inv.BULAN
				ORDER BY inv.PRODUCT_ID,inv.TGL
		")->queryAll(); 	
		
		// $qrySql= Yii::$app->production_api->createCommand($sql)->execute(); 		
		$dataProvider= new ArrayDataProvider([	
			'allModels'=>$qrySql,	
			'pagination' => [
				'pageSize' =>10000,
			],			
		]);
		
		if (!($this->load($params) && $this->validate())) {
 			return $dataProvider;
 		}
		
		// print_r($dataProvider);
		// die(); 
		
		// $filter = new Filter();
 		// $this->addCondition($filter, 'TGL_RUN', true);
 		// $this->addCondition($filter, 'TAHUN', true);
 		// $this->addCondition($filter, 'BULAN', true);	
 		// $this->addCondition($filter, 'ACCESS_GROUP', true);	
		// $this->addCondition($filter, 'STORE_ID', true);	
		// $this->addCondition($filter, 'KARYAWAN_ID', true);	
		// $this->addCondition($filter, 'KARYAWAN', true);	
		// $this->addCondition($filter, 'TGL', true);	
		// $this->addCondition($filter, 'MASUK', true);	
		// $this->addCondition($filter, 'KELUAR', true);	
		// $this->addCondition($filter, 'LONGITUDE', true);	
		// $this->addCondition($filter, 'LATITUDE', true);	
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
