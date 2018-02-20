<?php

namespace frontend\backend\laporan\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\backend\laporan\models\TransPengeluaranSummaryMonthly;

/**
 * TransPengeluaranSummaryMonthlySearch represents the model behind the search form about `frontend\backend\laporan\models\TransPengeluaranSummaryMonthly`.
 */
class TransPengeluaranSummaryMonthlySearch extends TransPengeluaranSummaryMonthly
{
	public function attributes()
	{
		return array_merge(parent::attributes(), ['storeNm','totalPengeluaran']);
	}
	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'BULAN', 'STATUS'], 'integer'],
            [['ACCESS_GROUP', 'STORE_ID', 'TAHUN', 'KETERANGAN', 'CREATE_AT', 'UPDATE_AT','storeNm','totalPengeluaran'], 'safe'],
            [['TTL_1', 'TTL_2', 'TTL_3', 'TTL_4', 'TTL_5', 'TTL_6', 'TTL_7', 'TTL_8', 'TTL_9', 'CNT_1', 'CNT_2', 'CNT_3', 'CNT_4', 'CNT_5', 'CNT_6', 'CNT_7', 'CNT_8', 'CNT_9'], 'number'],
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
        $query = TransPengeluaranSummaryMonthly::find();

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
            'TTL_1' => $this->TTL_1,
            'TTL_2' => $this->TTL_2,
            'TTL_3' => $this->TTL_3,
            'TTL_4' => $this->TTL_4,
            'TTL_5' => $this->TTL_5,
            'TTL_6' => $this->TTL_6,
            'TTL_7' => $this->TTL_7,
            'TTL_8' => $this->TTL_8,
            'TTL_9' => $this->TTL_9,
            'CNT_1' => $this->CNT_1,
            'CNT_2' => $this->CNT_2,
            'CNT_3' => $this->CNT_3,
            'CNT_4' => $this->CNT_4,
            'CNT_5' => $this->CNT_5,
            'CNT_6' => $this->CNT_6,
            'CNT_7' => $this->CNT_7,
            'CNT_8' => $this->CNT_8,
            'CNT_9' => $this->CNT_9,
            'STATUS' => $this->STATUS,
            'CREATE_AT' => $this->CREATE_AT,
            'UPDATE_AT' => $this->UPDATE_AT,
        ]);

        $query->andFilterWhere(['like', 'ACCESS_GROUP', $this->ACCESS_GROUP])
            ->andFilterWhere(['like', 'STORE_ID', $this->STORE_ID])
            ->andFilterWhere(['like', 'TAHUN', $this->TAHUN])
            ->andFilterWhere(['like', 'KETERANGAN', $this->KETERANGAN]);

        return $dataProvider;
    }
}
