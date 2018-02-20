<?php

namespace frontend\backend\laporan\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\backend\laporan\models\TransPengeluaranSummaryDaily;

/**
 * TransPengeluaranSummaryDailySearch represents the model behind the search form about `frontend\backend\laporan\models\TransPengeluaranSummaryDaily`.
 */
class TransPengeluaranSummaryDailySearch extends TransPengeluaranSummaryDaily
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'BULAN', 'ACCOUNT_ID', 'STATUS'], 'integer'],
            [['ACCESS_GROUP', 'STORE_ID', 'TAHUN', 'TGL', 'ACCOUNT_NM', 'KETERANGAN', 'CREATE_BY', 'CREATE_AT', 'UPDATE_BY', 'UPDATE_AT'], 'safe'],
            [['TOTAL_RUPIAH', 'TOTAL_QTY'], 'number'],
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
        $query = TransPengeluaranSummaryDaily::find();

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
            'BULAN' => $this->BULAN,
            'TGL' => $this->TGL,
            'ACCOUNT_ID' => $this->ACCOUNT_ID,
            'TOTAL_RUPIAH' => $this->TOTAL_RUPIAH,
            'TOTAL_QTY' => $this->TOTAL_QTY,
            'STATUS' => $this->STATUS,
            'CREATE_AT' => $this->CREATE_AT,
            'UPDATE_AT' => $this->UPDATE_AT,
        ]);

        $query->andFilterWhere(['like', 'ACCESS_GROUP', $this->ACCESS_GROUP])
            ->andFilterWhere(['like', 'STORE_ID', $this->STORE_ID])
            ->andFilterWhere(['like', 'TAHUN', $this->TAHUN])
            ->andFilterWhere(['like', 'ACCOUNT_NM', $this->ACCOUNT_NM])
            ->andFilterWhere(['like', 'KETERANGAN', $this->KETERANGAN])
            ->andFilterWhere(['like', 'CREATE_BY', $this->CREATE_BY])
            ->andFilterWhere(['like', 'UPDATE_BY', $this->UPDATE_BY]);

        return $dataProvider;
    }
}
