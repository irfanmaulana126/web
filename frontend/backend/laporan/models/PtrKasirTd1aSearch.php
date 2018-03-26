<?php

namespace frontend\backend\laporan\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\backend\laporan\models\PtrKasirTd1a;
use yii\data\ArrayDataProvider;

/**
 * PtrKasirTd1aSearch represents the model behind the search form of `frontend\backend\laporan\models\PtrKasirTd1a`.
 */
class PtrKasirTd1aSearch extends PtrKasirTd1a
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TRANS_DAY', 'ACCESS_GROUP', 'STORE_ID', 'TRANS_DATE', 'TAHUN', 'TGL', 'PRODUCT_ID', 'PRODUCT_NM', 'PRODUCT_PROVIDER', 'PRODUCT_PROVIDER_NO', 'PRODUCT_PROVIDER_NM', 'UNIT_NM', 'CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['BULAN', 'TRANS_TYPE', 'MONTH_AT', 'YEAR_AT'], 'integer'],
            [['SUB_TOTAL_QTY', 'SUB_TOTAL_HPP', 'SUB_TOTAL_PPN', 'SUB_TOTAL_JUAL', 'SUB_TOTAL_DISCOUNT', 'SUB_TOTAL_PROMO', 'PRODUK_SUBTTL_QTY', 'PRODUK_SUBTTL_HPP', 'PRODUK_SUBTTL_DISCOUNT', 'PRODUK_SUBTTL_PPN', 'PRODUK_SUBTTL_PROMO', 'PRODUK_SUBTTL_HARGAJUAL', 'PRODUK_JUALPPNDISCOUNT', 'REFUND_SUBTTL_QTY', 'REFUND_SUBTTL_HPP', 'REFUND_SUBTTL_DISCOUNT', 'REFUND_SUBTTL_PPN', 'REFUND_SUBTTL_PROMO', 'REFUND_SUBTTL_HARGAJUAL', 'REFUND_JUALPPNDISCOUNT', 'PPOB_SUBTTL_QTY', 'PPOB_SUBTTL_HPP', 'PPOB_SUBTTL_JUAL', 'OTHER_SUBTTL_QTY', 'OTHER_SUBTTL_HPP', 'OTHER_SUBTTL_JUAL', 'PRODUK_TUNAI_JUALPPNDISCOUNT', 'PRODUK_NONTUNAI_JUALPPNDISCOUNT', 'PPOB_TUNAI_JUAL', 'PPOB_NONTUNAI_JUAL', 'OTHER_TUNAI_JUAL', 'OTHER_NONTUNAI_JUAL'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }
    public function searchPpobToko($params){
		
		$accessGroup=Yii::$app->getUserOpt->user()['ACCESS_GROUP'];//'170726220936';
        $TGL=$this->BULAN!=''?$this->TAHUN.'-'.$this->BULAN.'-01':date('Y-m-d');
	  $STORE=$this->STORE_ID!=''?"and STORE_ID='".$this->STORE_ID."'":'';
	//    print_r($TGL);die();
	//    print_r("".$STORE."");die();
	  $sql="
		  SET SESSION GROUP_CONCAT_MAX_LEN = 1000000;
		  SET @tglIN=concat(date_format(LAST_DAY('".$TGL."' - interval 0 month),'%Y-%m-'),'01');
		  SET @tglOUT=LAST_DAY('".$TGL."');
		  DROP TEMPORARY TABLE IF EXISTS tmp_ppob".$accessGroup.";
		  CREATE TEMPORARY TABLE tmp_ppob".$accessGroup." as(
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
					  \"' THEN rslt1.PPOB_SUBTTL_QTY ELSE 0 END) AS 'QTY_\",DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),\"',\"												
				  ),
				  CONCAT(
					  \"MAX(CASE WHEN DATE_FORMAT(rslt1.TGL,'%Y-%m-%d') = '\",
					  DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),
					  \"' THEN rslt1.PPOB_SUBTTL_HPP ELSE 0 END) AS 'HPP_\",DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),\"',\"												
				  ),
				  CONCAT(
					\"MAX(CASE WHEN DATE_FORMAT(rslt1.TGL,'%Y-%m-%d') = '\",
					DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),
					\"' THEN rslt1.PPOB_SUBTTL_JUAL ELSE 0 END) AS 'JUAL_\",DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),\"'\"	#Stock Terjual per-hari										
				)
			  ) into @fildText
		  FROM	
		  tmp_ppob".$accessGroup." str1;			
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
			  rslt1.ACCESS_GROUP,rslt1.STORE_ID,st.STORE_NM,rslt1.PRODUCT_ID,rslt1.PRODUCT_NM,rslt1.TGL,rslt1.PPOB_SUBTTL_QTY,rslt1.PPOB_SUBTTL_HPP,rslt1.PPOB_SUBTTL_JUAL,".$rsltField." 
		  FROM
		  (
			  SELECT 
				  x2.ACCESS_GROUP,
				  x2.STORE_ID,
				  x2.PRODUCT_ID,
			  (CASE WHEN x2.PPOB_SUBTTL_QTY IS NOT NULL THEN x2.PPOB_SUBTTL_QTY ELSE 0 END) AS PPOB_SUBTTL_QTY,
			  (CASE WHEN x2.PPOB_SUBTTL_HPP IS NOT NULL THEN x2.PPOB_SUBTTL_HPP ELSE 0 END) AS PPOB_SUBTTL_HPP,
			  (CASE WHEN x2.PPOB_SUBTTL_JUAL IS NOT NULL THEN x2.PPOB_SUBTTL_JUAL ELSE 0 END) AS PPOB_SUBTTL_JUAL,
				   x2.PRODUCT_NM,x2.TGL
            FROM
              (SELECT ID_PRODUK,TYPE_NM,NAME,KELOMPOK
				  FROM ppob_master_data
			  ) x1
			  INNER JOIN
			  (
			  SELECT ACCESS_GROUP,STORE_ID,PRODUCT_ID,PRODUCT_NM,PRODUCT_PROVIDER,TGL,sum(PPOB_SUBTTL_QTY) as PPOB_SUBTTL_QTY,sum(PPOB_SUBTTL_HPP) as PPOB_SUBTTL_HPP,sum(PPOB_SUBTTL_JUAL) as PPOB_SUBTTL_JUAL
			  FROM ptr_kasir_td1a 
			  #WHERE ACCESS_GROUP='170726220936' AND STORE_ID='170726220936.0001' AND month(TGL)=month('2017-10-01')
			  WHERE ACCESS_GROUP='".$accessGroup."' AND month(TGL)=month('".$TGL."')".$STORE."
			  GROUP BY STORE_ID,PRODUCT_ID,TGL
			  ORDER BY STORE_ID,TGL
			  ) x2 on x1.ID_PRODUK=x2.PRODUCT_ID
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
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = PtrKasirTd1a::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'TRANS_DATE' => $this->TRANS_DATE,
            'BULAN' => $this->BULAN,
            'TGL' => $this->TGL,
            'TRANS_TYPE' => $this->TRANS_TYPE,
            'SUB_TOTAL_QTY' => $this->SUB_TOTAL_QTY,
            'SUB_TOTAL_HPP' => $this->SUB_TOTAL_HPP,
            'SUB_TOTAL_PPN' => $this->SUB_TOTAL_PPN,
            'SUB_TOTAL_JUAL' => $this->SUB_TOTAL_JUAL,
            'SUB_TOTAL_DISCOUNT' => $this->SUB_TOTAL_DISCOUNT,
            'SUB_TOTAL_PROMO' => $this->SUB_TOTAL_PROMO,
            'PRODUK_SUBTTL_QTY' => $this->PRODUK_SUBTTL_QTY,
            'PRODUK_SUBTTL_HPP' => $this->PRODUK_SUBTTL_HPP,
            'PRODUK_SUBTTL_DISCOUNT' => $this->PRODUK_SUBTTL_DISCOUNT,
            'PRODUK_SUBTTL_PPN' => $this->PRODUK_SUBTTL_PPN,
            'PRODUK_SUBTTL_PROMO' => $this->PRODUK_SUBTTL_PROMO,
            'PRODUK_SUBTTL_HARGAJUAL' => $this->PRODUK_SUBTTL_HARGAJUAL,
            'PRODUK_JUALPPNDISCOUNT' => $this->PRODUK_JUALPPNDISCOUNT,
            'REFUND_SUBTTL_QTY' => $this->REFUND_SUBTTL_QTY,
            'REFUND_SUBTTL_HPP' => $this->REFUND_SUBTTL_HPP,
            'REFUND_SUBTTL_DISCOUNT' => $this->REFUND_SUBTTL_DISCOUNT,
            'REFUND_SUBTTL_PPN' => $this->REFUND_SUBTTL_PPN,
            'REFUND_SUBTTL_PROMO' => $this->REFUND_SUBTTL_PROMO,
            'REFUND_SUBTTL_HARGAJUAL' => $this->REFUND_SUBTTL_HARGAJUAL,
            'REFUND_JUALPPNDISCOUNT' => $this->REFUND_JUALPPNDISCOUNT,
            'PPOB_SUBTTL_QTY' => $this->PPOB_SUBTTL_QTY,
            'PPOB_SUBTTL_HPP' => $this->PPOB_SUBTTL_HPP,
            'PPOB_SUBTTL_JUAL' => $this->PPOB_SUBTTL_JUAL,
            'OTHER_SUBTTL_QTY' => $this->OTHER_SUBTTL_QTY,
            'OTHER_SUBTTL_HPP' => $this->OTHER_SUBTTL_HPP,
            'OTHER_SUBTTL_JUAL' => $this->OTHER_SUBTTL_JUAL,
            'PRODUK_TUNAI_JUALPPNDISCOUNT' => $this->PRODUK_TUNAI_JUALPPNDISCOUNT,
            'PRODUK_NONTUNAI_JUALPPNDISCOUNT' => $this->PRODUK_NONTUNAI_JUALPPNDISCOUNT,
            'PPOB_TUNAI_JUAL' => $this->PPOB_TUNAI_JUAL,
            'PPOB_NONTUNAI_JUAL' => $this->PPOB_NONTUNAI_JUAL,
            'OTHER_TUNAI_JUAL' => $this->OTHER_TUNAI_JUAL,
            'OTHER_NONTUNAI_JUAL' => $this->OTHER_NONTUNAI_JUAL,
            'CREATE_AT' => $this->CREATE_AT,
            'UPDATE_AT' => $this->UPDATE_AT,
            'MONTH_AT' => $this->MONTH_AT,
            'YEAR_AT' => $this->YEAR_AT,
        ]);

        $query->andFilterWhere(['like', 'TRANS_DAY', $this->TRANS_DAY])
            ->andFilterWhere(['like', 'ACCESS_GROUP', $this->ACCESS_GROUP])
            ->andFilterWhere(['like', 'STORE_ID', $this->STORE_ID])
            ->andFilterWhere(['like', 'TAHUN', $this->TAHUN])
            ->andFilterWhere(['like', 'PRODUCT_ID', $this->PRODUCT_ID])
            ->andFilterWhere(['like', 'PRODUCT_NM', $this->PRODUCT_NM])
            ->andFilterWhere(['like', 'PRODUCT_PROVIDER', $this->PRODUCT_PROVIDER])
            ->andFilterWhere(['like', 'PRODUCT_PROVIDER_NO', $this->PRODUCT_PROVIDER_NO])
            ->andFilterWhere(['like', 'PRODUCT_PROVIDER_NM', $this->PRODUCT_PROVIDER_NM])
            ->andFilterWhere(['like', 'UNIT_NM', $this->UNIT_NM]);

        return $dataProvider;
    }
}
