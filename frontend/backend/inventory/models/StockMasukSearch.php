<?php

namespace frontend\backend\inventory\models;

use Yii;
use yii\base\Model;
use yii\base\DynamicModel;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Response;
use yii\data\ArrayDataProvider;
use yii\debug\components\search\Filter;
use yii\debug\components\search\matchers;

class StockMasukSearch extends DynamicModel
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
		$sql="
			SET SESSION GROUP_CONCAT_MAX_LEN = 1000000;
			SET @tglIN=concat(date_format(LAST_DAY('".$TGL."' - interval 0 month),'%Y-%m-'),'01');
			SET @tglOUT=LAST_DAY('".$TGL."');
			DROP TEMPORARY TABLE IF EXISTS tmp_stok".$accessGroup.";
			CREATE TEMPORARY TABLE tmp_stok".$accessGroup." as(
				SELECT a.Date as TGL_RUN
				FROM (
					select @tglOUT - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY as Date
					from (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) as a
					cross join (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) as b
					cross join (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) as c
				) a
				WHERE a.Date BETWEEN @tglIN AND @tglOUT ORDER BY a.Date ASC
			);
			SELECT				
				GROUP_CONCAT(DISTINCT					
					CONCAT(
						\"MAX(CASE WHEN DATE_FORMAT(rslt1.INPUT_DATE,'%Y-%m-%d') = '\",
						DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),
						\"' THEN rslt1.INPUT_STOCK ELSE 0 END) AS 'IN_\",DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),\"'\"												
					)
				) into @fildText
			FROM	
			tmp_stok".$accessGroup." str1;			
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
			SELECT 
				rslt1.ACCESS_GROUP,rslt1.STORE_ID,st.STORE_NM,rslt1.PRODUCT_ID,rslt1.PRODUCT_NM,rslt1.INPUT_DATE,rslt1.INPUT_STOCK,".$rsltField." 
			FROM
			(
				SELECT 
					(CASE WHEN x1.ACCESS_GROUP IS NOT NULL THEN x1.ACCESS_GROUP ELSE x2.ACCESS_GROUP END) AS ACCESS_GROUP,
					(CASE WHEN x1.STORE_ID IS NOT NULL THEN x1.STORE_ID ELSE x2.STORE_ID END) AS STORE_ID,
					(CASE WHEN x1.PRODUCT_ID IS NOT NULL THEN x1.PRODUCT_ID ELSE x2.PRODUCT_ID END) AS PRODUCT_ID,
				(CASE WHEN x2.INPUT_STOCK IS NOT NULL THEN x2.INPUT_STOCK ELSE 0 END) AS INPUT_STOCK,
					 x1.PRODUCT_NM,x2.INPUT_DATE
			  FROM
				(	SELECT ACCESS_GROUP,STORE_ID,PRODUCT_ID,PRODUCT_NM 
					FROM product  
					#WHERE ACCESS_GROUP='170726220936' AND STORE_ID='170726220936.0001'
					WHERE ACCESS_GROUP='".$accessGroup."' 
				) x1
				LEFT OUTER JOIN
				(
				SELECT ACCESS_GROUP,STORE_ID,PRODUCT_ID,INPUT_DATE,sum(INPUT_STOCK) as INPUT_STOCK
				FROM product_stock 
				#WHERE ACCESS_GROUP='170726220936' AND STORE_ID='170726220936.0001' AND month(INPUT_DATE)=month('2017-10-01')
				WHERE ACCESS_GROUP='".$accessGroup."' AND month(INPUT_DATE)=month('".$TGL."')
				GROUP BY STORE_ID,PRODUCT_ID,INPUT_DATE
				ORDER BY STORE_ID,INPUT_DATE
				) x2 on x2.PRODUCT_ID=x1.PRODUCT_ID
			) rslt1 left join store st on st.STORE_ID=rslt1.STORE_ID
			GROUP BY rslt1.STORE_ID,rslt1.PRODUCT_ID,month(rslt1.INPUT_DATE);
			ORDER BY rslt1.PRODUCT_ID ASC
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
 		$this->addCondition($filter, 'QTY', true);	 		
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
