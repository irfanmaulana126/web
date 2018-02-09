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

class CurrentStockSearch extends DynamicModel
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

	
	public function rules()
    {
        return [
           [['ACCESS_GROUP','STORE_ID','STORE_NM','NAMA_TOKO','TAHUN', 'BULAN','PRODUCT_ID','PRODUCT_NM','TTL_QTY','thn'], 'safe'],
		];	

    }	
		
	public function searchDayOfMonthStock($params){		
      	$accessGroup=Yii::$app->getUserOpt->user()['ACCESS_GROUP'];//'170726220936';
		$TGL=$this->thn!=''?$this->thn:date('Y-m-d');
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
							\"' THEN inv.STOCK_BARU ELSE 0 END) AS 'IN_\",DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),\"',\"		#Stock Baru	per-hari									
						),
						CONCAT(
							\"MAX(CASE WHEN DATE_FORMAT(inv.TGL,'%Y-%m-%d') = '\",
							DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),
							\"' THEN inv.STOCK_TERJUAL ELSE 0 END) AS 'OUT_\",DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),\"',\"	#Stock Terjual per-hari										
						),					
						CONCAT(
							\"MAX(CASE WHEN DATE_FORMAT(inv.TGL,'%Y-%m-%d') = '\",
							DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),
							\"' THEN inv.STOCK_SISA ELSE 0 END) AS 'SISA_\",DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),\"'\"		#Stock Sisa	per-hari									
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
				// print_r($rsltField);die();
		$qrySql= Yii::$app->production_api->createCommand("
			select 
				#===========================PR =========================================
				#=== 1. STOK REFUND - pengembalian stock karena cancel Transaksi     ===
				#=== 2. STOCK OPNAME (BALANCE OPNAME, sisa stock closing dan actual) ===
				#===========================PR =========================================
				inv.STORE_NM,
				inv.STORE_ID,
				inv.PRODUCT_NM,							
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
					(CASE WHEN a1.LALU <> '' THEN a1.LALU ELSE '0' END) AS STOCK_AWAL,				#Sisa stok bulan lalu
					(CASE WHEN a1.MASUK <> '' THEN a1.MASUK ELSE '0' END) AS STOCK_BARU,				#Penambahan stok bulan berjalan.
					(CASE WHEN a1.TERJUAL <> '' THEN a1.TERJUAL ELSE '0' END) AS STOCK_TERJUAL,		#Stok penjualan bulan berjalan.
					(CASE WHEN a1.OPNAME <> '' THEN a1.OPNAME ELSE '0' END)AS STOCK_OPNAME,			#Stok opname bulan berjalan.
					(CASE WHEN a1.SISA <> '' THEN a1.OPNAME ELSE '0' END) AS STOCK_SISA,				#Sisa stock daily of month.
					(CASE WHEN a1.STOCK_LAST_MONTH <> '' THEN a1.OPNAME ELSE '0' END) AS STOCK_LAST_MONTH,				#Stok Awal bulan, dari stok bulan lalu.
					a1.TGL,								#Tanggal day of month.
					a1.PRODUCT_ID,						#
					a1.STORE_ID,						#
					a2.PRODUCT_NM,						#
					a3.STORE_NM							#															
				FROM ptr_kasir_inv1c AS a1 
				left join product a2 on a2.PRODUCT_ID=a1.PRODUCT_ID
				left join store a3 on a3.STORE_ID=a1.STORE_ID
				WHERE a1.ACCESS_GROUP='".$accessGroup."' AND a1.TAHUN=YEAR('".$TGL."') AND a1.BULAN=MONTH('".$TGL."')				
			) inv
			GROUP BY inv.STORE_ID,inv.PRODUCT_ID				
		")->queryAll(); 
		// print_r($qrySql);die();	
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
