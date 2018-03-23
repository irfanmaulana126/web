<?php

namespace frontend\backend\laporan\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\backend\laporan\models\PtrKasirTd3a;
use yii\data\ArrayDataProvider;

/**
 * PtrKasirTd3aSearch represents the model behind the search form of `frontend\backend\laporan\models\PtrKasirTd3a`.
 */
class PtrKasirTd3aSearch extends PtrKasirTd3a
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TRANS_DAY', 'ACCESS_GROUP', 'STORE_ID', 'TRANS_DATE', 'TAHUN', 'CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['BULAN', 'MONTH_AT', 'YEAR_AT'], 'integer'],
            [['PRODUK_TTL_QTY', 'PRODUK_TTL_HPP', 'PRODUK_TTL_DISCOUNT', 'PRODUK_TTL_PPN', 'PRODUK_TTL_PROMO', 'PRODUK_TTL_HARGAJUAL', 'PRODUK_TTL_JUALPPNDISCOUNT', 'REFUND_TTL_QTY', 'REFUND_TTL_HPP', 'REFUND_TTL_DISCOUNT', 'REFUND_TTL_PPN', 'REFUND_TTL_PROMO', 'REFUND_TTL_HARGAJUAL', 'REFUND_TTL_JUALPPNDISCOUNT', 'PPOB_TTL_QTY', 'PPOB_TTL_HPP', 'PPOB_TTL_JUAL', 'OTHER_TTL_QTY', 'OTHER_TTL_HPP', 'OTHER_TTL_JUAL', 'TOTAL_QTY', 'TOTAL_JUAL', 'PRODUK_TUNAI_JUALPPNDISCOUNT', 'PRODUK_NONTUNAI_JUALPPNDISCOUNT', 'PPOB_TUNAI_JUAL', 'PPOB_NONTUNAI_JUAL', 'OTHER_TUNAI_JUAL', 'OTHER_NONTUNAI_JUAL'], 'number'],
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

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = PtrKasirTd3a::find();

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
            'PRODUK_TTL_QTY' => $this->PRODUK_TTL_QTY,
            'PRODUK_TTL_HPP' => $this->PRODUK_TTL_HPP,
            'PRODUK_TTL_DISCOUNT' => $this->PRODUK_TTL_DISCOUNT,
            'PRODUK_TTL_PPN' => $this->PRODUK_TTL_PPN,
            'PRODUK_TTL_PROMO' => $this->PRODUK_TTL_PROMO,
            'PRODUK_TTL_HARGAJUAL' => $this->PRODUK_TTL_HARGAJUAL,
            'PRODUK_TTL_JUALPPNDISCOUNT' => $this->PRODUK_TTL_JUALPPNDISCOUNT,
            'REFUND_TTL_QTY' => $this->REFUND_TTL_QTY,
            'REFUND_TTL_HPP' => $this->REFUND_TTL_HPP,
            'REFUND_TTL_DISCOUNT' => $this->REFUND_TTL_DISCOUNT,
            'REFUND_TTL_PPN' => $this->REFUND_TTL_PPN,
            'REFUND_TTL_PROMO' => $this->REFUND_TTL_PROMO,
            'REFUND_TTL_HARGAJUAL' => $this->REFUND_TTL_HARGAJUAL,
            'REFUND_TTL_JUALPPNDISCOUNT' => $this->REFUND_TTL_JUALPPNDISCOUNT,
            'PPOB_TTL_QTY' => $this->PPOB_TTL_QTY,
            'PPOB_TTL_HPP' => $this->PPOB_TTL_HPP,
            'PPOB_TTL_JUAL' => $this->PPOB_TTL_JUAL,
            'OTHER_TTL_QTY' => $this->OTHER_TTL_QTY,
            'OTHER_TTL_HPP' => $this->OTHER_TTL_HPP,
            'OTHER_TTL_JUAL' => $this->OTHER_TTL_JUAL,
            'TOTAL_QTY' => $this->TOTAL_QTY,
            'TOTAL_JUAL' => $this->TOTAL_JUAL,
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
            ->andFilterWhere(['like', 'TAHUN', $this->TAHUN]);

        return $dataProvider;
    }

    public function SearchPpob($params)
    {	
		$accessGroup=Yii::$app->getUserOpt->user()['ACCESS_GROUP'];//'170726220936';
        $TGL=$this->BULAN!=''?$this->TAHUN.'-'.$this->BULAN.'-01':date('Y-m-d');

        // print_r($TGL);die();
        $sql="
            SET SESSION GROUP_CONCAT_MAX_LEN = 1000000;
            SET @tglIN=concat(date_format(LAST_DAY('".$TGL."' - interval 0 month),'%Y-%m-'),'01');
            SET @tglOUT=LAST_DAY('".$TGL."');
            DROP TEMPORARY TABLE IF EXISTS tmp_donasi".$accessGroup.";
            CREATE TEMPORARY TABLE tmp_donasi".$accessGroup." as(
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
                        \"MAX(CASE WHEN DATE_FORMAT(rslt1.TRANS_DATE,'%Y-%m-%d') = '\",
                        DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),
                        \"' THEN rslt1.PPOB_TTL_QTY ELSE 0 END) AS 'QTY_\",DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),\"',\"												
                    ),
                    CONCAT(
                        \"MAX(CASE WHEN DATE_FORMAT(rslt1.TRANS_DATE,'%Y-%m-%d') = '\",
                        DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),
                        \"' THEN rslt1.PPOB_TTL_HPP ELSE 0 END) AS 'HPP_\",DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),\"',\"												
                    ),		
                    CONCAT(
                      \"MAX(CASE WHEN DATE_FORMAT(rslt1.TRANS_DATE,'%Y-%m-%d') = '\",
                      DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),
                      \"' THEN rslt1.PPOB_TTL_JUAL ELSE 0 END) AS 'JUAL_\",DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),\"'\"									
                  )
                ) into @fildText
            FROM	
            tmp_donasi".$accessGroup." str1;			
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
        // print_r($qrySqlField);die();
        $qrySql= Yii::$app->production_api->createCommand("
            SELECT 
                rslt1.ACCESS_GROUP,rslt1.STORE_ID,st.STORE_NM,rslt1.TRANS_DATE,rslt1.PPOB_TTL_QTY,rslt1.PPOB_TTL_HPP,rslt1.PPOB_TTL_JUAL,".$rsltField." 
            FROM
            (
                SELECT 
                    (CASE WHEN x1.ACCESS_GROUP IS NOT NULL THEN x1.ACCESS_GROUP ELSE x2.ACCESS_GROUP END) AS ACCESS_GROUP,
                    (CASE WHEN x1.STORE_ID IS NOT NULL THEN x1.STORE_ID ELSE x2.STORE_ID END) AS STORE_ID,
                (CASE WHEN x2.PPOB_TTL_QTY IS NOT NULL THEN x2.PPOB_TTL_QTY ELSE 0 END) AS PPOB_TTL_QTY,
                (CASE WHEN x2.PPOB_TTL_HPP IS NOT NULL THEN x2.PPOB_TTL_HPP ELSE 0 END) AS PPOB_TTL_HPP,
                (CASE WHEN x2.PPOB_TTL_JUAL IS NOT NULL THEN x2.PPOB_TTL_JUAL ELSE 0 END) AS PPOB_TTL_JUAL,
                    x2.TRANS_DATE
              FROM
                (	SELECT ACCESS_GROUP,STORE_ID 
                    FROM store  
                    #WHERE ACCESS_GROUP='170726220936' AND STORE_ID='170726220936.0001'
                    WHERE ACCESS_GROUP='".$accessGroup."'
                ) x1
                LEFT OUTER JOIN
                (
                SELECT ACCESS_GROUP,STORE_ID,TRANS_DATE,sum(PPOB_TTL_QTY) as PPOB_TTL_QTY,sum(PPOB_TTL_HPP) as PPOB_TTL_HPP,sum(PPOB_TTL_JUAL) as PPOB_TTL_JUAL
                FROM ptr_kasir_td3a
                #WHERE ACCESS_GROUP='170726220936' AND STORE_ID='170726220936.0001' AND month(TRANS_DATE)=month('2017-10-01')
                WHERE ACCESS_GROUP='".$accessGroup."' AND month(TRANS_DATE)=month('".$TGL."')
                GROUP BY STORE_ID,TRANS_DATE
                ORDER BY STORE_ID,TRANS_DATE
                ) x2 on x2.STORE_ID=x1.STORE_ID
            ) rslt1 left join store st on st.STORE_ID=rslt1.STORE_ID
            GROUP BY rslt1.STORE_ID,rslt1.STORE_ID,month(rslt1.TRANS_DATE);
            ORDER BY rslt1.STORE_ID ASC
        ")->queryAll(); 	
        
        // print_r($qrySql);die();
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
