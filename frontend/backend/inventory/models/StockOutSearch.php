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
	public $ACCESS_GROUP;
	public $STORE_ID;
	public $STORE_NM;
	public $TAHUN;
	public $BULAN;
	public $PRODUCT_ID;
	public $PRODUCT_NM;
	public $TTL_QTY;

	
	public function rules()
    {
        return [
           [['ACCESS_GROUP','STORE_ID','STORE_NM','TAHUN', 'BULAN','PRODUCT_ID','PRODUCT_NM','TTL_QTY'], 'safe'],
		];	

    }	
		
	//WHERE a.MONTH_AT='".date("Y-m-d", strtotime($this->BULAN))."' AND a.ACCESS_GROUP='".$this->ACCESS_GROUP."' AND a.STORE_ID='".$this->STORE_ID."'
	 //$query = TransPenjualanDetail::find()->where(['ACCESS_GROUP'=>Yii::$app->getUserOpt->user()['ACCESS_GROUP']]);
	public function search($params){

		$accessGroup=Yii::$app->getUserOpt->user()['ACCESS_GROUP'];//'170726220936';
		$tglIN='2017-11-01';
		$tglOUT='2017-11-30';
		$sql="
			SET SESSION GROUP_CONCAT_MAX_LEN = 1000000;
			DROP TEMPORARY TABLE IF EXISTS tmp_".$accessGroup.";
			CREATE TEMPORARY TABLE tmp_".$accessGroup." as(
				SELECT a.Date as TGL_RUN
				FROM (
					select '".$tglOUT."' - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY as Date
					from (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) as a
					cross join (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) as b
					cross join (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) as c
				) a
				WHERE a.Date BETWEEN  '".$tglIN."' AND '".$tglOUT."' ORDER BY a.Date ASC
			);
			SELECT				
				GROUP_CONCAT(DISTINCT					
					CONCAT(
						\"MAX(CASE WHEN DATE_FORMAT(inv.TGL,'%Y-%m-%d') = '\",
						DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),
						\"' THEN inv.INPUT_STOCK ELSE 0 END) AS 'IN_\",DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),\"',\"												
					),
					CONCAT(
						\"MAX(CASE WHEN DATE_FORMAT(inv.TGL,'%Y-%m-%d') = '\",
						DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),
						\"' THEN inv.PRODUCT_QTY ELSE 0 END) AS 'OUT_\",DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),\"',\"												
					),
					CONCAT(
						#'(100) +',
						\"SUM(CASE WHEN DATE_FORMAT(inv.TGL,'%Y-%m-%d') BETWEEN '".$tglIN."' AND '\",
						DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),
						\"' THEN  inv.INPUT_STOCK END) -\",
						\"SUM(CASE WHEN DATE_FORMAT(inv.TGL,'%Y-%m-%d') BETWEEN '".$tglIN."' AND '\",
						DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),
						\"' THEN inv.PRODUCT_QTY ELSE 0 END) \"						
						\" AS 'SISA_\",DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),\"'\"												
					)
				) into @fildText
			FROM	
			tmp_".$accessGroup." str1;			
		";		
		$qrySqlField=Yii::$app->production_api->createCommand($sql)->execute();
		$qrySqlField= Yii::$app->production_api->createCommand("	
			select @fildText ;
		")->queryAll(); 
		$dpFieldtext= new ArrayDataProvider([	
			'allModels'=>$qrySqlField,	
			'pagination' => [
				'pageSize' =>10000,
			],			
		]);		
		$rsltField=$dpFieldtext->getModels()[0]['@fildText'];
		
		$qrySql= Yii::$app->production_api->createCommand("
				SELECT inv.ACCESS_GROUP,inv.STORE_ID,st.STORE_NM,inv.TAHUN,inv.BULAN,inv.PRODUCT_ID,inv.PRODUCT_NM,SUM(inv.PRODUCT_QTY) AS TTL_IN,SUM(inv.PRODUCT_QTY) AS TTL_OUT,".$rsltField."
				FROM
				(SELECT
						(CASE WHEN x1.ACCESS_GROUP<>'' THEN x1.ACCESS_GROUP ELSE x2.ACCESS_GROUP END) AS  ACCESS_GROUP,
						(CASE WHEN x1.STORE_ID<>'' THEN x1.STORE_ID ELSE x2.STORE_ID END) AS  STORE_ID,
						(CASE WHEN x1.TAHUN<>'' THEN x1.TAHUN ELSE x1.TAHUN END) AS  TAHUN,
						(CASE WHEN x1.BULAN<>'' THEN x1.BULAN ELSE x1.BULAN END) AS  BULAN,
						(CASE WHEN x1.TGL<>'' THEN x1.TGL ELSE x1.TGL END) AS  TGL,
						(CASE WHEN x1.PRODUCT_ID<>'' THEN x1.PRODUCT_ID ELSE x2.PRODUCT_ID END) AS  PRODUCT_ID,
						(CASE WHEN x1.PRODUCT_NM<>'' THEN x1.PRODUCT_NM ELSE x2.PRODUCT_NM END) AS  PRODUCT_NM,
						(CASE WHEN x1.PRODUCT_QTY<>'' THEN x1.PRODUCT_QTY ELSE '0' END) AS  PRODUCT_QTY,
						(CASE WHEN x3.INPUT_STOCK<>'' THEN x3.INPUT_STOCK ELSE '0' END) AS  INPUT_STOCK
					FROM
					(
						SELECT ACCESS_GROUP,STORE_ID,TAHUN,BULAN,TGL,PRODUCT_ID,PRODUCT_NM,PRODUCT_QTY
						FROM trans_penjualan_detail_summary_daily
						#WHERE ACCESS_GROUP='170726220936' AND STORE_ID='170726220936.0001' AND TGL BETWEEN '2017-11-01' AND '2017-11-30' #PER-STORE
						WHERE ACCESS_GROUP='".$accessGroup."' AND  TGL BETWEEN '".$tglIN."' AND '".$tglOUT."'
					)x1 RIGHT JOIN
					( 
						SELECT ACCESS_GROUP,STORE_ID,PRODUCT_ID,PRODUCT_NM
						FROM product 
						#WHERE ACCESS_GROUP='170726220936' AND STORE_ID='170726220936.0001'	#PER-STORE
						WHERE ACCESS_GROUP='".$accessGroup."'	
					)x2 ON x2.ACCESS_GROUP=x1.ACCESS_GROUP AND x2.STORE_ID=x1.STORE_ID AND x2.PRODUCT_ID=x1.PRODUCT_ID LEFT JOIN
					(
						SELECT ACCESS_GROUP,STORE_ID,PRODUCT_ID,INPUT_DATE,sum(INPUT_STOCK) as INPUT_STOCK
						FROM product_stock
						WHERE ACCESS_GROUP='".$accessGroup."' AND  (INPUT_DATE BETWEEN '".$tglIN."' AND '".$tglOUT."')
						GROUP BY STORE_ID,PRODUCT_ID,INPUT_DATE
					)x3 ON x3.ACCESS_GROUP=x1.ACCESS_GROUP AND x3.STORE_ID=x1.STORE_ID AND x3.PRODUCT_ID=x1.PRODUCT_ID AND x3.INPUT_DATE=x1.TGL
				) inv LEFT JOIN store st on st.STORE_ID=inv.STORE_ID
				GROUP BY inv.STORE_ID,inv.PRODUCT_ID,inv.BULAN
				ORDER BY inv.PRODUCT_ID,inv.TGL
		")->queryAll(); 	
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
		$this->addCondition($filter, 'TAHUN', true);
 		$this->addCondition($filter, 'BULAN', true);	
 		$this->addCondition($filter, 'PRODUCT_ID', true);	
 		$this->addCondition($filter, 'PRODUCT_NM', true);	 		
 		$this->addCondition($filter, 'TTL_QTY', true);	 		
 		$dataProvider->allModels = $filter->filter($qrySql);
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
