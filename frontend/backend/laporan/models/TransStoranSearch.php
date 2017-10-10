<?php

namespace frontend\backend\laporan\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\backend\laporan\models\TransStoran;

/**
 * TransStoranSearch represents the model behind the search form about `frontend\backend\laporan\models\TransStoran`.
 */
class TransStoranSearch extends TransStoran
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'STATUS', 'YEAR_AT', 'MONTH_AT'], 'integer'],
            [['ACCESS_GROUP', 'STORE_ID', 'ACCESS_ID', 'OPENCLOSE_ID', 'TGL_STORAN', 'BANK_NM', 'BANK_NO', 'CREATE_BY', 'CREATE_AT', 'UPDATE_BY', 'UPDATE_AT', 'DCRP_DETIL'], 'safe'],
            [['TOTALCASH', 'NOMINAL_STORAN', 'SISA_STORAN'], 'number'],
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
        $query = TransStoran::find();

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
            'ID' => $this->ID,
            'TGL_STORAN' => $this->TGL_STORAN,
            'TOTALCASH' => $this->TOTALCASH,
            'NOMINAL_STORAN' => $this->NOMINAL_STORAN,
            'SISA_STORAN' => $this->SISA_STORAN,
            'CREATE_AT' => $this->CREATE_AT,
            'UPDATE_AT' => $this->UPDATE_AT,
            'STATUS' => $this->STATUS,
            'YEAR_AT' => $this->YEAR_AT,
            'MONTH_AT' => $this->MONTH_AT,
        ]);

        $query->andFilterWhere(['like', 'ACCESS_GROUP', $this->ACCESS_GROUP])
            ->andFilterWhere(['like', 'STORE_ID', $this->STORE_ID])
            ->andFilterWhere(['like', 'ACCESS_ID', $this->ACCESS_ID])
            ->andFilterWhere(['like', 'OPENCLOSE_ID', $this->OPENCLOSE_ID])
            ->andFilterWhere(['like', 'BANK_NM', $this->BANK_NM])
            ->andFilterWhere(['like', 'BANK_NO', $this->BANK_NO])
            ->andFilterWhere(['like', 'CREATE_BY', $this->CREATE_BY])
            ->andFilterWhere(['like', 'UPDATE_BY', $this->UPDATE_BY])
            ->andFilterWhere(['like', 'DCRP_DETIL', $this->DCRP_DETIL]);

        return $dataProvider;
    }
}
