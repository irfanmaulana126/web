<?php

namespace frontend\backend\laporan\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\backend\laporan\models\PtrKasirTh1aDonasi;
use yii\data\ArrayDataProvider;

/**
 * PtrKasirTh1aDonasiSearch represents the model behind the search form of `frontend\backend\laporan\models\PtrKasirTh1aDonasi`.
 */
class PtrKasirTh1aDonasiSearch extends PtrKasirTh1aDonasi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TRANS_ID', 'ACCESS_GROUP', 'STORE_ID', 'STORE_NM', 'TRANS_DATE', 'TGL', 'CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['TAHUN', 'BULAN', 'STT', 'MONTH_AT', 'YEAR_AT'], 'integer'],
            [['JUMLAH_DONASI'], 'number'],
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
        $query = PtrKasirTh1aDonasi::find();

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
            'TAHUN' => $this->TAHUN,
            'BULAN' => $this->BULAN,
            'TGL' => $this->TGL,
            'JUMLAH_DONASI' => $this->JUMLAH_DONASI,
            'STT' => $this->STT,
            'CREATE_AT' => $this->CREATE_AT,
            'UPDATE_AT' => $this->UPDATE_AT,
            'MONTH_AT' => $this->MONTH_AT,
            'YEAR_AT' => $this->YEAR_AT,
        ]);

        $query->andFilterWhere(['like', 'TRANS_ID', $this->TRANS_ID])
            ->andFilterWhere(['like', 'ACCESS_GROUP', $this->ACCESS_GROUP])
            ->andFilterWhere(['like', 'STORE_ID', $this->STORE_ID])
            ->andFilterWhere(['like', 'STORE_NM', $this->STORE_NM]);

        return $dataProvider;
    }
    public function SearchDonasi($params)
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
                      \"MAX(CASE WHEN DATE_FORMAT(rslt1.TGL,'%Y-%m-%d') = '\",
                      DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),
                      \"' THEN rslt1.JUMLAH_DONASI ELSE 0 END) AS 'IN_\",DATE_FORMAT(str1.TGL_RUN,'%Y-%m-%d'),\"'\"	#Stock Terjual per-hari										
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
               st.STORE_NM,".$rsltField." 
            FROM
            (
                SELECT 
                    (CASE WHEN x1.ACCESS_GROUP IS NOT NULL THEN x1.ACCESS_GROUP ELSE x2.ACCESS_GROUP END) AS ACCESS_GROUP,
                    (CASE WHEN x1.STORE_ID IS NOT NULL THEN x1.STORE_ID ELSE x2.STORE_ID END) AS STORE_ID,
                (CASE WHEN x2.JUMLAH_DONASI IS NOT NULL THEN x2.JUMLAH_DONASI ELSE 0 END) AS JUMLAH_DONASI,
                    x2.TGL
              FROM
                (	SELECT ACCESS_GROUP,STORE_ID 
                    FROM store  
                    #WHERE ACCESS_GROUP='170726220936' AND STORE_ID='170726220936.0001'
                    WHERE ACCESS_GROUP='".$accessGroup."'
                ) x1
                LEFT OUTER JOIN
                (
                SELECT ACCESS_GROUP,STORE_ID,TGL,sum(JUMLAH_DONASI) as JUMLAH_DONASI
                FROM ptr_kasir_th1a_donasi
                #WHERE ACCESS_GROUP='170726220936' AND STORE_ID='170726220936.0001' AND month(TGL)=month('2017-10-01')
                WHERE ACCESS_GROUP='".$accessGroup."' AND month(TGL)=month('".$TGL."')
                GROUP BY STORE_ID,TGL
                ORDER BY STORE_ID,TGL
                ) x2 on x2.STORE_ID=x1.STORE_ID
            ) rslt1 left join store st on st.STORE_ID=rslt1.STORE_ID
            GROUP BY rslt1.STORE_ID,rslt1.STORE_ID,month(rslt1.TGL);
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
