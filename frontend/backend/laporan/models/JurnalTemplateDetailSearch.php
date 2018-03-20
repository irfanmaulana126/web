<?php

namespace frontend\backend\laporan\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\backend\laporan\models\JurnalTemplateDetail;

/**
 * JurnalTemplateDetailSearch represents the model behind the search form of `frontend\backend\laporan\models\JurnalTemplateDetail`.
 */
class JurnalTemplateDetailSearch extends JurnalTemplateDetail
{
    /**
     * @inheritdoc
     */
    public $BULAN;
    public $TAHUN;
    public $STORE_ID;
    public function rules()
    {
        return [
            [['RPT_DETAIL_ID', 'STORE_ID','BULAN','TAHUN','ACCESS_GROUP', 'AKUN_CODE', 'KTG_CODE', 'AKUN_NM', 'KTG_NM', 'RPT_TITLE_NM', 'RPT_GROUP_NM', 'CAL_FORMULA_NM', 'STATUS_NM', 'KETERANGAN', 'CREATE_BY', 'UPDATE_BY', 'CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['RPT_SORTING', 'RPT_TITLE_ID', 'RPT_GROUP_ID', 'CAL_FORMULA', 'STATUS', 'MONTH_AT', 'YEAR_AT'], 'integer'],
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
        $query = JurnalTemplateDetail::find();
        $query->join('INNER JOIN','jurnal_transaksi_c',['STORE_ID'=>''.$this->STORE_ID.'']);
		$query->orderBy('RPT_SORTING ASC');
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'pagination' => [
				'pageSize' =>10000,
			],	
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            //'RPT_SORTING' => $this->RPT_SORTING,
            'RPT_TITLE_ID' => $this->RPT_TITLE_ID,
            'RPT_GROUP_ID' => $this->RPT_GROUP_ID,
            'CAL_FORMULA' => $this->CAL_FORMULA,
            'STATUS' => $this->STATUS,
            'CREATE_AT' => $this->CREATE_AT,
            'UPDATE_AT' => $this->UPDATE_AT,
            'MONTH_AT' => $this->MONTH_AT,
            'YEAR_AT' => $this->YEAR_AT,
            'STORE_ID' => $this->STORE_ID,
        ]);

        $query->andFilterWhere(['like', 'RPT_DETAIL_ID', $this->RPT_DETAIL_ID])
        ->andFilterWhere(['like', 'ACCESS_GROUP', $this->ACCESS_GROUP])
        ->andFilterWhere(['like', 'AKUN_CODE', $this->AKUN_CODE])
        ->andFilterWhere(['like', 'KTG_CODE', $this->KTG_CODE])
        ->andFilterWhere(['like', 'AKUN_NM', $this->AKUN_NM])
        ->andFilterWhere(['like', 'KTG_NM', $this->KTG_NM])
        ->andFilterWhere(['like', 'RPT_TITLE_NM', $this->RPT_TITLE_NM])
        ->andFilterWhere(['like', 'RPT_GROUP_NM', $this->RPT_GROUP_NM])
        ->andFilterWhere(['like', 'CAL_FORMULA_NM', $this->CAL_FORMULA_NM])
        ->andFilterWhere(['like', 'STATUS_NM', $this->STATUS_NM])
        ->andFilterWhere(['like', 'KETERANGAN', $this->KETERANGAN])
        ->andFilterWhere(['like', 'CREATE_BY', $this->CREATE_BY])
        ->andFilterWhere(['like', 'UPDATE_BY', $this->UPDATE_BY]);
        //$query->groupBy('AKUN_NM');
       
        
        return $dataProvider;
    }
}
