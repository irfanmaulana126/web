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

class StockOutSearch extends DynamicModel
{
	public $ACCESS_GROUP;
	public $STORE_ID;
	public $STORE_NM;
	public $NAMA_TOKO;
	public $TAHUN;
	public $BULAN;
	public $PRODUCT_ID;
	public $PRODUCT_NM;
	public $TTL_QTY;
	public $uploadExport;
	
	public function rules()
    {
        return [
			[['uploadExport'], 'file', 'skipOnEmpty' => false, 'extensions' => 'xlsx, xls'],
			[['ACCESS_GROUP','STORE_ID','STORE_NM','NAMA_TOKO','TAHUN', 'BULAN','PRODUCT_ID','PRODUCT_NM','TTL_QTY','thn'], 'safe'],
		];	

    }	
		
	//WHERE a.MONTH_AT='".date("Y-m-d", strtotime($this->BULAN))."' AND a.ACCESS_GROUP='".$this->ACCESS_GROUP."' AND a.STORE_ID='".$this->STORE_ID."'
	 //$query = TransPenjualanDetail::find()->where(['ACCESS_GROUP'=>Yii::$app->getUserOpt->user()['ACCESS_GROUP']]);
	public function search($params){		
      	$accessGroup=Yii::$app->getUserOpt->user()['ACCESS_GROUP'];//'170726220936';
		$TGL=$this->thn!=''?$this->thn:date('Y-m-d');
		//$TGL='2018-01-19';
		$sql="
			SET SESSION GROUP_CONCAT_MAX_LEN = 1000000;
			SET @tglIN=concat(date_format(LAST_DAY('".$TGL."' - interval 0 month),'%Y-%m-'),'01');
			SET @tglOUT=LAST_DAY('".$TGL."');
			DROP TEMPORARY TABLE IF EXISTS tmp_".$accessGroup.";
			CREATE TEMPORARY TABLE tmp_".$accessGroup." as(
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
						\"MAX(CASE WHEN DATE_FORMAT(inv.TGL,'%Y-%m-%d') = '\",
						DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),
						\"' THEN inv.STOCK_BARU ELSE 0 END) AS 'IN_\",DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),\"',\"												
					),
					CONCAT(
						\"MAX(CASE WHEN DATE_FORMAT(inv.TGL,'%Y-%m-%d') = '\",
						DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),
						\"' THEN inv.STOCK_TERJUAL ELSE 0 END) AS 'OUT_\",DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),\"',\"												
					),
					CONCAT(
						'(CASE WHEN inv.STOCK_AWAL IS NOT NULL THEN inv.STOCK_AWAL ELSE 0 END) + ',
						\"SUM(CASE WHEN DATE_FORMAT(inv.TGL,'%Y-%m-%d') BETWEEN '".$TGL."' AND '\",
						DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),
						\"' THEN  inv.STOCK_BARU END) -\",
						\"SUM(CASE WHEN DATE_FORMAT(inv.TGL,'%Y-%m-%d') BETWEEN '".$TGL."' AND '\",
						DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),
						\"' THEN inv.STOCK_TERJUAL ELSE 0 END) \"						
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
		// print_r($qrySqlField);die();
		$dpFieldtext= new ArrayDataProvider([	
			'allModels'=>$qrySqlField,	
			'pagination' => [
				'pageSize' =>10000,
			],			
		]);		
		$rsltField=$dpFieldtext->getModels()[0]['@fildText'];
		
		$qrySql= Yii::$app->production_api->createCommand("
					SELECT inv.ACCESS_GROUP,inv.STORE_ID,st.STORE_NM,inv.TAHUN,inv.BULAN,inv.PRODUCT_ID,inv.PRODUCT_NM,
							SUM(inv.STOCK_BARU) AS TTL_STOCK_BARU,SUM(inv.STOCK_TERJUAL) AS TTL_STOCK_TERJUAL,
							(CASE WHEN inv.STOCK_AWAL IS NOT NULL THEN (inv.STOCK_AWAL + SUM(inv.STOCK_BARU)-SUM(inv.STOCK_TERJUAL)) 
							ELSE (SUM(inv.STOCK_BARU)-SUM(inv.STOCK_TERJUAL)) END) AS TTL_STOCK_SISA,
							inv.STOCK_AWAL,inv.STOCK_AKHIR,inv.STOCK_AKHIR_ACTUAL,
							".$rsltField."
					FROM
					(SELECT
							(CASE WHEN x1.ACCESS_GROUP<>'' THEN x1.ACCESS_GROUP ELSE x2.ACCESS_GROUP END) AS  ACCESS_GROUP,
							(CASE WHEN x1.STORE_ID<>'' THEN x1.STORE_ID ELSE x2.STORE_ID END) AS  STORE_ID,
							(CASE WHEN x1.TAHUN<>'' THEN x1.TAHUN ELSE x1.TAHUN END) AS  TAHUN,
							(CASE WHEN x1.BULAN<>'' THEN x1.BULAN ELSE x1.BULAN END) AS  BULAN,
							(CASE WHEN x1.TGL<>'' THEN x1.TGL ELSE x1.TGL END) AS  TGL,
							(CASE WHEN x1.PRODUCT_ID<>'' THEN x1.PRODUCT_ID ELSE x2.PRODUCT_ID END) AS  PRODUCT_ID,
							(CASE WHEN x1.PRODUCT_NM<>'' THEN x1.PRODUCT_NM ELSE x2.PRODUCT_NM END) AS  PRODUCT_NM,
							(CASE WHEN x1.PRODUCT_QTY<>'' THEN x1.PRODUCT_QTY ELSE '0' END) AS  STOCK_TERJUAL,
							(CASE WHEN x3.INPUT_STOCK<>'' THEN x3.INPUT_STOCK ELSE '0' END) AS  STOCK_BARU,
							 x4.STOCK_AWAL,x4.STOCK_AKHIR,x4.STOCK_AKHIR_ACTUAL
						FROM
						(
							SELECT ACCESS_GROUP,STORE_ID,TAHUN,BULAN,TGL,PRODUCT_ID,PRODUCT_NM,PRODUCT_QTY
							FROM trans_penjualan_detail_summary_daily
							#WHERE ACCESS_GROUP='170726220936' AND STORE_ID='170726220936.0001' AND TGL BETWEEN '2017-11-01' AND '2017-11-30' #PER-STORE
							WHERE ACCESS_GROUP='".$accessGroup."' AND  (TGL BETWEEN concat(date_format(LAST_DAY('".$TGL."' - interval 0 month),'%Y-%m-'),'01') AND LAST_DAY('".$TGL."'))
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
							WHERE ACCESS_GROUP='".$accessGroup."' AND  (INPUT_DATE BETWEEN concat(date_format(LAST_DAY('".$TGL."' - interval 0 month),'%Y-%m-'),'01') AND LAST_DAY('".$TGL."'))
							GROUP BY STORE_ID,PRODUCT_ID,INPUT_DATE
						)x3 ON x3.ACCESS_GROUP=x1.ACCESS_GROUP AND x3.STORE_ID=x1.STORE_ID AND x3.PRODUCT_ID=x1.PRODUCT_ID AND x3.INPUT_DATE=x1.TGL LEFT JOIN
						(
							SELECT ACCESS_GROUP,STORE_ID,PRODUCT_ID,
								(CASE WHEN STOCK_AWAL<>STOCK_AWAL_ACTUAL THEN STOCK_AWAL_ACTUAL ELSE STOCK_AWAL END) AS STOCK_AWAL,
								STOCK_AKHIR,STOCK_AKHIR_ACTUAL
							FROM product_stock_closing
							WHERE ACCESS_GROUP='".$accessGroup."' AND TAHUN=YEAR('".$TGL."') AND BULAN=MONTH('".$TGL."')
							#GROUP BY ACCESS_GROUP,STORE_ID,TAHUN,BULAN,PRODUCT_ID
						)x4 ON x4.ACCESS_GROUP=x1.ACCESS_GROUP AND x4.STORE_ID=x1.STORE_ID AND x4.PRODUCT_ID=x1.PRODUCT_ID AND TAHUN=year('".$TGL."') AND BULAN=month('".$TGL."')
					) inv LEFT JOIN store st on st.STORE_ID=inv.STORE_ID
					GROUP BY inv.STORE_ID,inv.PRODUCT_ID,inv.BULAN
					ORDER BY inv.PRODUCT_ID,inv.TGL
		")->queryAll(); 	
		print_r($qrySql);die();	
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
	
	public function searchPrint($params){
		
      	$accessGroup=Yii::$app->getUserOpt->user()['ACCESS_GROUP'];//'170726220936';
		$TGL=$this->thn!=''?$this->thn:date('Y-m-d');
		//$tglOUT='2017-11-30';
		$sql="
			SET SESSION GROUP_CONCAT_MAX_LEN = 1000000;
			SET @tglIN=concat(date_format(LAST_DAY('".$TGL."' - interval 0 month),'%Y-%m-'),'01');
			SET @tglOUT=LAST_DAY('".$TGL."');
			DROP TEMPORARY TABLE IF EXISTS tmpPrint_".$accessGroup.";
			CREATE TEMPORARY TABLE tmpPrint_".$accessGroup." as(
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
						\"MAX(CASE WHEN DATE_FORMAT(inv.TGL,'%Y-%m-%d') = '\",
						DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),
						\"' THEN inv.STOCK_BARU ELSE 0 END) AS 'IN_\",DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),\"',\"												
					),
					CONCAT(
						\"MAX(CASE WHEN DATE_FORMAT(inv.TGL,'%Y-%m-%d') = '\",
						DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),
						\"' THEN inv.STOCK_TERJUAL ELSE 0 END) AS 'OUT_\",DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),\"',\"												
					),
					CONCAT(
						'(CASE WHEN inv.STOCK_AWAL IS NOT NULL THEN inv.STOCK_AWAL ELSE 0 END) + ',
						\"SUM(CASE WHEN DATE_FORMAT(inv.TGL,'%Y-%m-%d') BETWEEN '".$TGL."' AND '\",
						DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),
						\"' THEN  inv.STOCK_BARU END) -\",
						\"SUM(CASE WHEN DATE_FORMAT(inv.TGL,'%Y-%m-%d') BETWEEN '".$TGL."' AND '\",
						DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),
						\"' THEN inv.STOCK_TERJUAL ELSE 0 END) \"						
						\" AS 'SISA_\",DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),\"'\"												
					)
				) into @fildText
			FROM	
			tmpPrint_".$accessGroup." str1;			
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
					SELECT  st.STORE_NM AS NAMA_TOKO,
							(inv.PRODUCT_NM) AS PRODUK,
							(CASE WHEN inv.STOCK_AWAL IS NOT NULL THEN inv.STOCK_AWAL ELSE 0 END) AS TTL_LALU,
							SUM(inv.STOCK_BARU) AS TTL_MASUK,
							SUM(inv.STOCK_TERJUAL) AS TTL_JUAL,
							(CASE WHEN inv.STOCK_AWAL IS NOT NULL THEN (inv.STOCK_AWAL + SUM(inv.STOCK_BARU)-SUM(inv.STOCK_TERJUAL)) 
							ELSE (SUM(inv.STOCK_BARU)-SUM(inv.STOCK_TERJUAL)) END) AS TTL_SISA,
							".$rsltField.",
							(CASE WHEN inv.STOCK_AKHIR IS NOT NULL THEN inv.STOCK_AKHIR ELSE 0 END) AS Closing,
							(CASE WHEN inv.STOCK_AKHIR_ACTUAL IS NOT NULL THEN inv.STOCK_AKHIR_ACTUAL ELSE 0 END) AS Actual
												
					FROM
					(SELECT
							(CASE WHEN x1.ACCESS_GROUP<>'' THEN x1.ACCESS_GROUP ELSE x2.ACCESS_GROUP END) AS  ACCESS_GROUP,
							(CASE WHEN x1.STORE_ID<>'' THEN x1.STORE_ID ELSE x2.STORE_ID END) AS  STORE_ID,
							(CASE WHEN x1.TAHUN<>'' THEN x1.TAHUN ELSE x1.TAHUN END) AS  TAHUN,
							(CASE WHEN x1.BULAN<>'' THEN x1.BULAN ELSE x1.BULAN END) AS  BULAN,
							(CASE WHEN x1.TGL<>'' THEN x1.TGL ELSE x1.TGL END) AS  TGL,
							(CASE WHEN x1.PRODUCT_ID<>'' THEN x1.PRODUCT_ID ELSE x2.PRODUCT_ID END) AS  PRODUCT_ID,
							(CASE WHEN x1.PRODUCT_NM<>'' THEN x1.PRODUCT_NM ELSE x2.PRODUCT_NM END) AS  PRODUCT_NM,
							(CASE WHEN x1.PRODUCT_QTY<>'' THEN x1.PRODUCT_QTY ELSE '0' END) AS  STOCK_TERJUAL,
							(CASE WHEN x3.INPUT_STOCK<>'' THEN x3.INPUT_STOCK ELSE '0' END) AS  STOCK_BARU,
							 x4.STOCK_AWAL,x4.STOCK_AKHIR,x4.STOCK_AKHIR_ACTUAL
						FROM
						(
							SELECT ACCESS_GROUP,STORE_ID,TAHUN,BULAN,TGL,PRODUCT_ID,PRODUCT_NM,PRODUCT_QTY
							FROM trans_penjualan_detail_summary_daily
							#WHERE ACCESS_GROUP='170726220936' AND STORE_ID='170726220936.0001' AND TGL BETWEEN '2017-11-01' AND '2017-11-30' #PER-STORE
							WHERE ACCESS_GROUP='".$accessGroup."' AND  (TGL BETWEEN concat(date_format(LAST_DAY('".$TGL."' - interval 0 month),'%Y-%m-'),'01') AND LAST_DAY('".$TGL."'))
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
							WHERE ACCESS_GROUP='".$accessGroup."' AND  (INPUT_DATE BETWEEN concat(date_format(LAST_DAY('".$TGL."' - interval 0 month),'%Y-%m-'),'01') AND LAST_DAY('".$TGL."'))
							GROUP BY STORE_ID,PRODUCT_ID,INPUT_DATE
						)x3 ON x3.ACCESS_GROUP=x1.ACCESS_GROUP AND x3.STORE_ID=x1.STORE_ID AND x3.PRODUCT_ID=x1.PRODUCT_ID AND x3.INPUT_DATE=x1.TGL LEFT JOIN
						(
							SELECT ACCESS_GROUP,STORE_ID,PRODUCT_ID,
								(CASE WHEN STOCK_AWAL<>STOCK_AWAL_ACTUAL THEN STOCK_AWAL_ACTUAL ELSE STOCK_AWAL END) AS STOCK_AWAL,
								STOCK_AKHIR,STOCK_AKHIR_ACTUAL
							FROM product_stock_closing
							WHERE ACCESS_GROUP='".$accessGroup."' AND TAHUN=YEAR('".$TGL."') AND BULAN=MONTH('".$TGL."')
							#GROUP BY ACCESS_GROUP,STORE_ID,TAHUN,BULAN,PRODUCT_ID
						)x4 ON x4.ACCESS_GROUP=x1.ACCESS_GROUP AND x4.STORE_ID=x1.STORE_ID AND x4.PRODUCT_ID=x1.PRODUCT_ID AND TAHUN=year('".$TGL."') AND BULAN=month('".$TGL."')
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
	
	public function searchOpname($params){
		
      	$accessGroup=Yii::$app->getUserOpt->user()['ACCESS_GROUP'];//'170726220936';
		$TGL=$this->thn!=''?$this->thn:date('Y-m-d');
		// $TGL='2017-11-01';
		
		$qrySql= Yii::$app->production_api->createCommand("
					SELECT  st.STORE_NM,inv.STORE_ID,
							(inv.PRODUCT_NM) AS PRODUK,
							(CASE WHEN inv.STOCK_AWAL IS NOT NULL THEN inv.STOCK_AWAL ELSE 0 END) AS TTL_LALU,
							SUM(inv.STOCK_BARU) AS TTL_MASUK,
							SUM(inv.STOCK_TERJUAL) AS TTL_JUAL,
							(CASE WHEN inv.STOCK_AWAL IS NOT NULL THEN (inv.STOCK_AWAL + SUM(inv.STOCK_BARU)-SUM(inv.STOCK_TERJUAL)) 
							ELSE (SUM(inv.STOCK_BARU)-SUM(inv.STOCK_TERJUAL)) END) AS TTL_SISA,
							(CASE WHEN inv.STOCK_AKHIR IS NOT NULL THEN inv.STOCK_AKHIR ELSE 0 END) AS Closing,
							(CASE WHEN inv.STOCK_AKHIR_ACTUAL IS NOT NULL THEN inv.STOCK_AKHIR_ACTUAL ELSE 0 END) AS Actual
					FROM
					(SELECT
							(CASE WHEN x1.ACCESS_GROUP<>'' THEN x1.ACCESS_GROUP ELSE x2.ACCESS_GROUP END) AS  ACCESS_GROUP,
							x2.STORE_ID  AS  STORE_ID,
							(CASE WHEN x1.TAHUN<>'' THEN x1.TAHUN ELSE x1.TAHUN END) AS  TAHUN,
							(CASE WHEN x1.BULAN<>'' THEN x1.BULAN ELSE x1.BULAN END) AS  BULAN,
							(CASE WHEN x1.TGL<>'' THEN x1.TGL ELSE x1.TGL END) AS  TGL,
							(CASE WHEN x1.PRODUCT_ID<>'' THEN x1.PRODUCT_ID ELSE x2.PRODUCT_ID END) AS  PRODUCT_ID,
							(CASE WHEN x1.PRODUCT_NM<>'' THEN x1.PRODUCT_NM ELSE x2.PRODUCT_NM END) AS  PRODUCT_NM,
							(CASE WHEN x1.PRODUCT_QTY<>'' THEN x1.PRODUCT_QTY ELSE '0' END) AS  STOCK_TERJUAL,
							(CASE WHEN x3.INPUT_STOCK<>'' THEN x3.INPUT_STOCK ELSE '0' END) AS  STOCK_BARU,
							 x4.STOCK_AWAL,x4.STOCK_AKHIR,x4.STOCK_AKHIR_ACTUAL
						FROM
						(
							SELECT ACCESS_GROUP,STORE_ID,TAHUN,BULAN,TGL,PRODUCT_ID,PRODUCT_NM,PRODUCT_QTY
							FROM trans_penjualan_detail_summary_daily
							#WHERE ACCESS_GROUP='170726220936' AND STORE_ID='170726220936.0001' AND TGL BETWEEN '2017-11-01' AND '2017-11-30' #PER-STORE
							WHERE ACCESS_GROUP='".$accessGroup."' AND  (TGL BETWEEN concat(date_format(LAST_DAY('".$TGL."' - interval 0 month),'%Y-%m-'),'01') AND LAST_DAY('".$TGL."'))
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
							WHERE ACCESS_GROUP='".$accessGroup."' AND  (INPUT_DATE BETWEEN concat(date_format(LAST_DAY('".$TGL."' - interval 0 month),'%Y-%m-'),'01') AND LAST_DAY('".$TGL."'))
							GROUP BY STORE_ID,PRODUCT_ID,INPUT_DATE
						)x3 ON x3.ACCESS_GROUP=x1.ACCESS_GROUP AND x3.STORE_ID=x1.STORE_ID AND x3.PRODUCT_ID=x1.PRODUCT_ID AND x3.INPUT_DATE=x1.TGL LEFT JOIN
						(
							SELECT ACCESS_GROUP,STORE_ID,PRODUCT_ID,
								(CASE WHEN STOCK_AWAL<>STOCK_AWAL_ACTUAL THEN STOCK_AWAL_ACTUAL ELSE STOCK_AWAL END) AS STOCK_AWAL,
								STOCK_AKHIR,STOCK_AKHIR_ACTUAL
							FROM product_stock_closing
							WHERE ACCESS_GROUP='".$accessGroup."' AND TAHUN=YEAR('".$TGL."') AND BULAN=MONTH('".$TGL."')
							#GROUP BY ACCESS_GROUP,STORE_ID,TAHUN,BULAN,PRODUCT_ID
						)x4 ON x4.ACCESS_GROUP=x1.ACCESS_GROUP AND x4.STORE_ID=x1.STORE_ID AND x4.PRODUCT_ID=x1.PRODUCT_ID AND TAHUN=year('".$TGL."') AND BULAN=month('".$TGL."')
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
		$this->addCondition($filter, 'NAMA_TOKO', true);	
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
	
	public function searchDayOfMonthStock($params){
		
      	$accessGroup='170726220936';//Yii::$app->getUserOpt->user()['ACCESS_GROUP'];//'170726220936';
		$TGL=$this->thn!=''?$this->thn:date('Y-m-d');
		//$tglOUT='2017-11-30';
		$sql="
			SET SESSION GROUP_CONCAT_MAX_LEN = 1000000;
				SET @tglIN=concat(date_format(LAST_DAY('".$TGL."' - interval 0 month),'%Y-%m-'),'01');
				SET @tglOUT=LAST_DAY('".$TGL."');
				DROP TEMPORARY TABLE IF EXISTS tmp_".$accessGroup.";
				CREATE TEMPORARY TABLE tmp_".$accessGroup." as(
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
							\"MAX(CASE WHEN DATE_FORMAT(inv.TGL,'%Y-%m-%d') = '\",
							DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),
							\"' THEN inv.STOCK_BARU ELSE 0 END) AS 'IN_\",DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),\"',\"												
						),
						CONCAT(
							\"MAX(CASE WHEN DATE_FORMAT(inv.TGL,'%Y-%m-%d') = '\",
							DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),
							\"' THEN inv.STOCK_TERJUAL ELSE 0 END) AS 'OUT_\",DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),\"',\"												
						),					
						CONCAT(
							\"MAX(CASE WHEN DATE_FORMAT(inv.TGL,'%Y-%m-%d') = '\",
							DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),
							\"' THEN inv.STOCK_SISA ELSE 0 END) AS 'SISA_\",DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),\"'\"												
						)					
					) into @fildText
				FROM	
				tmp_".$accessGroup." str1;						
		";		
		$qrySqlField=Yii::$app->production_api->createCommand($sql)->execute();
		$qrySqlField= Yii::$app->production_api->createCommand("	
			select @fildText;
		")->queryAll(); 
		$dpFieldtext= new ArrayDataProvider([	
			'allModels'=>$qrySqlField,	
			'pagination' => [
				'pageSize' =>10000,
			],			
		]);		
		$rsltField=$dpFieldtext->getModels()[0]['@fildText'];
				
		$qrySql= Yii::$app->production_api->createCommand("
			select 
				#===========================PR =========================================
				#=== 1. STOK REFUND - pengembalian stock karena cancel Transaksi     ===
				#=== 2. STOCK OPNAME (BALANCE OPNAME, sisa stock closing dan actual) ===
				#===========================PR =========================================
				inv.STORE_NM,inv.STORE_ID,inv.PRODUCT_NM,							
				".$rsltField.",							
				inv.STOCK_AWAL,																					#Stok Bulan Lalu, menjadi stock Awal bulan.
				sum(inv.STOCK_BARU) AS TTL_STOCK_BARU,															#Penambahan Stok di Bulan berjalan.
				sum(inv.STOCK_TERJUAL) AS TTL_STOCK_TERJUAL,													#Stok terjual di bulan berjalan.
				sum(STOCK_LAST_MONTH +inv.STOCK_BARU)-SUM(inv.STOCK_TERJUAL) AS TTL_STOCK_SISA,					#Sisa stok dari, penjumlahan sisa stok bulan lalu, penambahan dan penjualan bulan berjalan.			
				sum(STOCK_LAST_MONTH +inv.STOCK_BARU)-SUM(inv.STOCK_TERJUAL+STOCK_OPNAME) AS STOCK_AKHIR,		#Stock Akhir Closing tanpa opname.
				sum(inv.STOCK_OPNAME) AS TTL_STOCK_OPNAME,														#total Balance Stok Opname.
				sum(STOCK_LAST_MONTH +inv.STOCK_BARU)-SUM(inv.STOCK_TERJUAL+STOCK_OPNAME) AS STOCK_AKHIR_ACTUAL	#Actual Stock setelah opname.
			from
			(
				SELECT  
					LALU AS STOCK_AWAL,					#Sisa stok bulan lalu
					MASUK AS STOCK_BARU,				#Penambahan stok bulan berjalan.
					TERJUAL AS STOCK_TERJUAL,			#Stok penjualan bulan berjalan.
					OPNAME AS STOCK_OPNAME,				#Stok opname bulan berjalan.
					SISA AS STOCK_SISA,					#Sisa stock daily of month.
					STOCK_LAST_MONTH,					#Stok Awal bulan, dari stok bulan lalu.
					TGL,								#Tanggal day of month.
					STORE_ID AS STORE_NM,STORE_ID,		#
					PRODUCT_ID AS PRODUCT_NM,PRODUCT_ID	#					
				FROM ptr_kasir_inv1c 
				WHERE ACCESS_GROUP='170726220936' AND TAHUN=YEAR('".$TGL."') AND BULAN=MONTH('".$TGL."')				
			) inv
			GROUP BY inv.STORE_ID,inv.PRODUCT_ID				
		")->queryAll(); 	
		$dataProvider= new ArrayDataProvider([	
			'allModels'=>$qrySql,	
			'pagination' => [
				'pageSize' =>10000,
			],			
		]);					
				
		//return $rsltField;
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
	public function upload()
    {
        if ($this->validate()) {
            $this->uploadExport->saveAs('uploads/' . $this->uploadExport->baseName . '.' . $this->uploadExport->extension);
            return true;
        } else {
            return false;
        }
    } 
}
