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

	public $ACCESS_GROUP;
	public $STORE_ID;
	public $TAHUN;
	public $BULAN;
	//public $BLN;
    /**
     * @inheritdoc	
     */
    public function rules()
    {
        return [
            [['KREDIT','KREDIT','TAHUN','ACCESS_GROUP','STORE_ID','BULAN'], 'safe'],
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
				jc.TAHUN='".$this->TAHUN."' AND 
				jc.BULAN='".$this->BULAN."' AND
				jc.ACCESS_GROUP='".$this->ACCESS_GROUP."'
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
	public function searchArusKeuanganStore($params){
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
				jc.TAHUN='".$this->TAHUN."' AND 
				jc.BULAN='".$this->BULAN."' AND
				jc.ACCESS_GROUP='".$this->ACCESS_GROUP."' AND
				jc.STORE_ID='".$this->STORE_ID."'
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
	public function searchArusDetail31001($params){
		
		$accessGroup=Yii::$app->getUserOpt->user()['ACCESS_GROUP'];//'170726220936';
	  $TGL=$this->BULAN!=''?$this->BULAN:date('Y-m-d');
	  $STORE=$this->STORE_ID!=''?"and STORE_ID='".$this->STORE_ID."'":'';
	//    print_r($STORE);die();
	//    print_r("".$STORE."");die();
	  $sql="
		  SET SESSION GROUP_CONCAT_MAX_LEN = 1000000;
		  SET @tglIN=concat(date_format(LAST_DAY('".$TGL."' - interval 0 month),'%Y-%m-'),'01');
		  SET @tglOUT=LAST_DAY('".$TGL."');
		  DROP TEMPORARY TABLE IF EXISTS tmp_arus".$accessGroup.";
		  CREATE TEMPORARY TABLE tmp_arus".$accessGroup." as(
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
					  \"MAX(CASE WHEN DATE_FORMAT(rslt1.TGL,'%Y-%m-%d') = '\",
					  DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),
					  \"' THEN rslt1.PRODUK_SUBTTL_HARGAJUAL ELSE 0 END) AS 'IN_\",DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),\"',\"												
				  ),
				  CONCAT(
					\"MAX(CASE WHEN DATE_FORMAT(rslt1.TGL,'%Y-%m-%d') = '\",
					DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),
					\"' THEN rslt1.PRODUK_SUBTTL_QTY ELSE 0 END) AS 'OUT_\",DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),\"'\"	#Stock Terjual per-hari										
				)
			  ) into @fildText
		  FROM	
		  tmp_arus".$accessGroup." str1;			
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
	//   print_r($qrySqlField);die();
	  $qrySql= Yii::$app->production_api->createCommand("
		  SELECT 
			  rslt1.ACCESS_GROUP,rslt1.STORE_ID,st.STORE_NM,rslt1.PRODUCT_ID,rslt1.PRODUCT_NM,rslt1.TGL,rslt1.PRODUK_SUBTTL_HARGAJUAL,rslt1.PRODUK_SUBTTL_QTY,".$rsltField." 
		  FROM
		  (
			  SELECT 
				  (CASE WHEN x1.ACCESS_GROUP IS NOT NULL THEN x1.ACCESS_GROUP ELSE x2.ACCESS_GROUP END) AS ACCESS_GROUP,
				  (CASE WHEN x1.STORE_ID IS NOT NULL THEN x1.STORE_ID ELSE x2.STORE_ID END) AS STORE_ID,
				  (CASE WHEN x1.PRODUCT_ID IS NOT NULL THEN x1.PRODUCT_ID ELSE x2.PRODUCT_ID END) AS PRODUCT_ID,
			  (CASE WHEN x2.PRODUK_SUBTTL_HARGAJUAL IS NOT NULL THEN x2.PRODUK_SUBTTL_HARGAJUAL ELSE 0 END) AS PRODUK_SUBTTL_HARGAJUAL,
			  (CASE WHEN x2.PRODUK_SUBTTL_QTY IS NOT NULL THEN x2.PRODUK_SUBTTL_QTY ELSE 0 END) AS PRODUK_SUBTTL_QTY,
				   x1.PRODUCT_NM,x2.TGL
			FROM
			  (	SELECT ACCESS_GROUP,STORE_ID,PRODUCT_ID,PRODUCT_NM 
				  FROM product  
				  #WHERE ACCESS_GROUP='170726220936' AND STORE_ID='170726220936.0001'
				  WHERE ACCESS_GROUP='".$accessGroup."' ".$STORE."
			  ) x1
			  LEFT OUTER JOIN
			  (
			  SELECT ACCESS_GROUP,STORE_ID,PRODUCT_ID,TGL,sum(PRODUK_SUBTTL_HARGAJUAL) as PRODUK_SUBTTL_HARGAJUAL,sum(PRODUK_SUBTTL_QTY) as PRODUK_SUBTTL_QTY
			  FROM ptr_kasir_td1a 
			  #WHERE ACCESS_GROUP='170726220936' AND STORE_ID='170726220936.0001' AND month(TGL)=month('2017-10-01')
			  WHERE ACCESS_GROUP='".$accessGroup."' AND month(TGL)=month('".$TGL."') ".$STORE."
			  GROUP BY STORE_ID,PRODUCT_ID,TGL
			  ORDER BY STORE_ID,TGL
			  ) x2 on x2.PRODUCT_ID=x1.PRODUCT_ID
		  ) rslt1 left join store st on st.STORE_ID=rslt1.STORE_ID
		  GROUP BY rslt1.STORE_ID,rslt1.PRODUCT_ID,month(rslt1.TGL);
		  ORDER BY rslt1.PRODUCT_ID ASC
	  ")->queryAll(); 	
	  
	//   print_r($qrySql);die();
	  $dataProvider= new ArrayDataProvider([	
		  'allModels'=>$qrySql,	
		  'pagination' => [
			  'pageSize' =>10000,
		  ],			
	  ]);
	  
	  if (!($this->load($params) && $this->validate())) {
		   return $dataProvider;
	   }
	  
	  return $dataProvider;
  } 
	public function searchArusDetail31002($params){
		
		$accessGroup=Yii::$app->getUserOpt->user()['ACCESS_GROUP'];//'170726220936';
		$TGL=$this->BULAN!=''?$this->BULAN:date('Y-m-d');
		$STORE=$this->STORE_ID!=''?"and STORE_ID='".$this->STORE_ID."'":'';
	  //  $TGL='2017-10-30';
	  $sql="
		  SET SESSION GROUP_CONCAT_MAX_LEN = 1000000;
		  SET @tglIN=concat(date_format(LAST_DAY('".$TGL."' - interval 0 month),'%Y-%m-'),'01');
		  SET @tglOUT=LAST_DAY('".$TGL."');
		  DROP TEMPORARY TABLE IF EXISTS tmp_arus".$accessGroup.";
		  CREATE TEMPORARY TABLE tmp_arus".$accessGroup." as(
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
					  \"MAX(CASE WHEN DATE_FORMAT(rslt1.TGL,'%Y-%m-%d') = '\",
					  DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),
					  \"' THEN rslt1.PRODUK_JUALPPNDISCOUNT ELSE 0 END) AS 'IN_\",DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),\"',\"												
				  ),
				  CONCAT(
					\"MAX(CASE WHEN DATE_FORMAT(rslt1.TGL,'%Y-%m-%d') = '\",
					DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),
					\"' THEN rslt1.PRODUK_SUBTTL_QTY ELSE 0 END) AS 'OUT_\",DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),\"'\"	#Stock Terjual per-hari										
				)
			  ) into @fildText
		  FROM	
		  tmp_arus".$accessGroup." str1;			
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
	//   print_r($qrySqlField);die();
	  $qrySql= Yii::$app->production_api->createCommand("
		  SELECT 
			  rslt1.ACCESS_GROUP,rslt1.STORE_ID,st.STORE_NM,rslt1.PRODUCT_ID,rslt1.PRODUCT_NM,rslt1.TGL,rslt1.PRODUK_JUALPPNDISCOUNT,rslt1.PRODUK_SUBTTL_QTY,".$rsltField." 
		  FROM
		  (
			  SELECT 
				  (CASE WHEN x1.ACCESS_GROUP IS NOT NULL THEN x1.ACCESS_GROUP ELSE x2.ACCESS_GROUP END) AS ACCESS_GROUP,
				  (CASE WHEN x1.STORE_ID IS NOT NULL THEN x1.STORE_ID ELSE x2.STORE_ID END) AS STORE_ID,
				  (CASE WHEN x1.PRODUCT_ID IS NOT NULL THEN x1.PRODUCT_ID ELSE x2.PRODUCT_ID END) AS PRODUCT_ID,
			  (CASE WHEN x2.PRODUK_JUALPPNDISCOUNT IS NOT NULL THEN x2.PRODUK_JUALPPNDISCOUNT ELSE 0 END) AS PRODUK_JUALPPNDISCOUNT,
			  (CASE WHEN x2.PRODUK_SUBTTL_QTY IS NOT NULL THEN x2.PRODUK_SUBTTL_QTY ELSE 0 END) AS PRODUK_SUBTTL_QTY,
				   x1.PRODUCT_NM,x2.TGL
			FROM
			  (	SELECT ACCESS_GROUP,STORE_ID,PRODUCT_ID,PRODUCT_NM 
				  FROM product  
				  #WHERE ACCESS_GROUP='170726220936' AND STORE_ID='170726220936.0001'
				  WHERE ACCESS_GROUP='".$accessGroup."' ".$STORE."
			  ) x1
			  LEFT OUTER JOIN
			  (
			  SELECT ACCESS_GROUP,STORE_ID,PRODUCT_ID,TGL,sum(PRODUK_JUALPPNDISCOUNT) as PRODUK_JUALPPNDISCOUNT,sum(PRODUK_SUBTTL_QTY) as PRODUK_SUBTTL_QTY
			  FROM ptr_kasir_td1a 
			  #WHERE ACCESS_GROUP='170726220936' AND STORE_ID='170726220936.0001' AND month(TGL)=month('2017-10-01')
			  WHERE ACCESS_GROUP='".$accessGroup."' AND month(TGL)=month('".$TGL."')".$STORE."
			  GROUP BY STORE_ID,PRODUCT_ID,TGL
			  ORDER BY STORE_ID,TGL
			  ) x2 on x2.PRODUCT_ID=x1.PRODUCT_ID
		  ) rslt1 left join store st on st.STORE_ID=rslt1.STORE_ID
		  GROUP BY rslt1.STORE_ID,rslt1.PRODUCT_ID,month(rslt1.TGL);
		  ORDER BY rslt1.PRODUCT_ID ASC
	  ")->queryAll(); 	
	  
	//   print_r($qrySql);die();
	  $dataProvider= new ArrayDataProvider([	
		  'allModels'=>$qrySql,	
		  'pagination' => [
			  'pageSize' =>10000,
		  ],			
	  ]);
	  
	  if (!($this->load($params) && $this->validate())) {
		   return $dataProvider;
	   }
	  
	  return $dataProvider;
  } 
	public function searchArusDetail31003($params){
		
		$accessGroup=Yii::$app->getUserOpt->user()['ACCESS_GROUP'];//'170726220936';
		$TGL=$this->BULAN!=''?$this->BULAN:date('Y-m-d');
		$STORE=$this->STORE_ID!=''?"and STORE_ID='".$this->STORE_ID."'":'';
	  //  $TGL='2017-10-30';
	  $sql="
		  SET SESSION GROUP_CONCAT_MAX_LEN = 1000000;
		  SET @tglIN=concat(date_format(LAST_DAY('".$TGL."' - interval 0 month),'%Y-%m-'),'01');
		  SET @tglOUT=LAST_DAY('".$TGL."');
		  DROP TEMPORARY TABLE IF EXISTS tmp_arus".$accessGroup.";
		  CREATE TEMPORARY TABLE tmp_arus".$accessGroup." as(
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
					  \"MAX(CASE WHEN DATE_FORMAT(rslt1.TGL,'%Y-%m-%d') = '\",
					  DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),
					  \"' THEN rslt1.PRODUK_SUBTTL_PPN ELSE 0 END) AS 'IN_\",DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),\"',\"												
				  ),
				  CONCAT(
					\"MAX(CASE WHEN DATE_FORMAT(rslt1.TGL,'%Y-%m-%d') = '\",
					DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),
					\"' THEN rslt1.PRODUK_SUBTTL_QTY ELSE 0 END) AS 'OUT_\",DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),\"'\"	#Stock Terjual per-hari										
				)
			  ) into @fildText
		  FROM	
		  tmp_arus".$accessGroup." str1;			
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
	//   print_r($qrySqlField);die();
	  $qrySql= Yii::$app->production_api->createCommand("
		  SELECT 
			  rslt1.ACCESS_GROUP,rslt1.STORE_ID,st.STORE_NM,rslt1.PRODUCT_ID,rslt1.PRODUCT_NM,rslt1.TGL,rslt1.PRODUK_SUBTTL_PPN,rslt1.PRODUK_SUBTTL_QTY,".$rsltField." 
		  FROM
		  (
			  SELECT 
				  (CASE WHEN x1.ACCESS_GROUP IS NOT NULL THEN x1.ACCESS_GROUP ELSE x2.ACCESS_GROUP END) AS ACCESS_GROUP,
				  (CASE WHEN x1.STORE_ID IS NOT NULL THEN x1.STORE_ID ELSE x2.STORE_ID END) AS STORE_ID,
				  (CASE WHEN x1.PRODUCT_ID IS NOT NULL THEN x1.PRODUCT_ID ELSE x2.PRODUCT_ID END) AS PRODUCT_ID,
			  (CASE WHEN x2.PRODUK_SUBTTL_PPN IS NOT NULL THEN x2.PRODUK_SUBTTL_PPN ELSE 0 END) AS PRODUK_SUBTTL_PPN,
			  (CASE WHEN x2.PRODUK_SUBTTL_QTY IS NOT NULL THEN x2.PRODUK_SUBTTL_QTY ELSE 0 END) AS PRODUK_SUBTTL_QTY,
				   x1.PRODUCT_NM,x2.TGL
			FROM
			  (	SELECT ACCESS_GROUP,STORE_ID,PRODUCT_ID,PRODUCT_NM 
				  FROM product  
				  #WHERE ACCESS_GROUP='170726220936' AND STORE_ID='170726220936.0001'
				  WHERE ACCESS_GROUP='".$accessGroup."' ".$STORE."
			  ) x1
			  LEFT OUTER JOIN
			  (
			  SELECT ACCESS_GROUP,STORE_ID,PRODUCT_ID,TGL,sum(PRODUK_SUBTTL_PPN) as PRODUK_SUBTTL_PPN,sum(PRODUK_SUBTTL_QTY) as PRODUK_SUBTTL_QTY
			  FROM ptr_kasir_td1a 
			  #WHERE ACCESS_GROUP='170726220936' AND STORE_ID='170726220936.0001' AND month(TGL)=month('2017-10-01')
			  WHERE ACCESS_GROUP='".$accessGroup."' AND month(TGL)=month('".$TGL."')".$STORE."
			  GROUP BY STORE_ID,PRODUCT_ID,TGL
			  ORDER BY STORE_ID,TGL
			  ) x2 on x2.PRODUCT_ID=x1.PRODUCT_ID
		  ) rslt1 left join store st on st.STORE_ID=rslt1.STORE_ID
		  GROUP BY rslt1.STORE_ID,rslt1.PRODUCT_ID,month(rslt1.TGL);
		  ORDER BY rslt1.PRODUCT_ID ASC
	  ")->queryAll(); 	
	  
	//   print_r($qrySql);die();
	  $dataProvider= new ArrayDataProvider([	
		  'allModels'=>$qrySql,	
		  'pagination' => [
			  'pageSize' =>10000,
		  ],			
	  ]);
	  
	  if (!($this->load($params) && $this->validate())) {
		   return $dataProvider;
	   }
	  
	  return $dataProvider;
  } 
	public function searchArusDetail41001($params){
		
		$accessGroup=Yii::$app->getUserOpt->user()['ACCESS_GROUP'];//'170726220936';
		$TGL=$this->BULAN!=''?$this->BULAN:date('Y-m-d');
		$STORE=$this->STORE_ID!=''?"and STORE_ID='".$this->STORE_ID."'":'';
	  //  $TGL='2017-10-30';
	  $sql="
		  SET SESSION GROUP_CONCAT_MAX_LEN = 1000000;
		  SET @tglIN=concat(date_format(LAST_DAY('".$TGL."' - interval 0 month),'%Y-%m-'),'01');
		  SET @tglOUT=LAST_DAY('".$TGL."');
		  DROP TEMPORARY TABLE IF EXISTS tmp_arus".$accessGroup.";
		  CREATE TEMPORARY TABLE tmp_arus".$accessGroup." as(
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
					  \"MAX(CASE WHEN DATE_FORMAT(rslt1.TGL,'%Y-%m-%d') = '\",
					  DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),
					  \"' THEN rslt1.REFUND_SUBTTL_HARGAJUAL ELSE 0 END) AS 'IN_\",DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),\"',\"												
				  ),
				  CONCAT(
					\"MAX(CASE WHEN DATE_FORMAT(rslt1.TGL,'%Y-%m-%d') = '\",
					DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),
					\"' THEN rslt1.REFUND_SUBTTL_QTY ELSE 0 END) AS 'OUT_\",DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),\"'\"	#Stock Terjual per-hari										
				)
			  ) into @fildText
		  FROM	
		  tmp_arus".$accessGroup." str1;			
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
	//   print_r($qrySqlField);die();
	  $qrySql= Yii::$app->production_api->createCommand("
		  SELECT 
			  rslt1.ACCESS_GROUP,rslt1.STORE_ID,st.STORE_NM,rslt1.PRODUCT_ID,rslt1.PRODUCT_NM,rslt1.TGL,rslt1.REFUND_SUBTTL_HARGAJUAL,rslt1.REFUND_SUBTTL_QTY,".$rsltField." 
		  FROM
		  (
			  SELECT 
				  (CASE WHEN x1.ACCESS_GROUP IS NOT NULL THEN x1.ACCESS_GROUP ELSE x2.ACCESS_GROUP END) AS ACCESS_GROUP,
				  (CASE WHEN x1.STORE_ID IS NOT NULL THEN x1.STORE_ID ELSE x2.STORE_ID END) AS STORE_ID,
				  (CASE WHEN x1.PRODUCT_ID IS NOT NULL THEN x1.PRODUCT_ID ELSE x2.PRODUCT_ID END) AS PRODUCT_ID,
			  (CASE WHEN x2.REFUND_SUBTTL_HARGAJUAL IS NOT NULL THEN x2.REFUND_SUBTTL_HARGAJUAL ELSE 0 END) AS REFUND_SUBTTL_HARGAJUAL,
			  (CASE WHEN x2.REFUND_SUBTTL_QTY IS NOT NULL THEN x2.REFUND_SUBTTL_QTY ELSE 0 END) AS REFUND_SUBTTL_QTY,
				   x1.PRODUCT_NM,x2.TGL
			FROM
			  (	SELECT ACCESS_GROUP,STORE_ID,PRODUCT_ID,PRODUCT_NM 
				  FROM product  
				  #WHERE ACCESS_GROUP='170726220936' AND STORE_ID='170726220936.0001'
				  WHERE ACCESS_GROUP='".$accessGroup."' ".$STORE."
			  ) x1
			  LEFT OUTER JOIN
			  (
			  SELECT ACCESS_GROUP,STORE_ID,PRODUCT_ID,TGL,sum(REFUND_SUBTTL_HARGAJUAL) as REFUND_SUBTTL_HARGAJUAL,sum(REFUND_SUBTTL_QTY) as REFUND_SUBTTL_QTY
			  FROM ptr_kasir_td1a 
			  #WHERE ACCESS_GROUP='170726220936' AND STORE_ID='170726220936.0001' AND month(TGL)=month('2017-10-01')
			  WHERE ACCESS_GROUP='".$accessGroup."' AND month(TGL)=month('".$TGL."')".$STORE."
			  GROUP BY STORE_ID,PRODUCT_ID,TGL
			  ORDER BY STORE_ID,TGL
			  ) x2 on x2.PRODUCT_ID=x1.PRODUCT_ID
		  ) rslt1 left join store st on st.STORE_ID=rslt1.STORE_ID
		  GROUP BY rslt1.STORE_ID,rslt1.PRODUCT_ID,month(rslt1.TGL);
		  ORDER BY rslt1.PRODUCT_ID ASC
	  ")->queryAll(); 	
	  
	//   print_r($qrySql);die();
	  $dataProvider= new ArrayDataProvider([	
		  'allModels'=>$qrySql,	
		  'pagination' => [
			  'pageSize' =>10000,
		  ],			
	  ]);
	  
	  if (!($this->load($params) && $this->validate())) {
		   return $dataProvider;
	   }
	  
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
