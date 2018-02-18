<?php

namespace frontend\backend\dashboard\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\backend\dashboard\models\StoreKasir;

/**
 * StoreKasirSearch represents the model behind the search form of `frontend\backend\dashboard\models\StoreKasir`.
 */
class StoreKasirSearch extends StoreKasir
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['KASIR_ID', 'KASIR_NM', 'ACCESS_GROUP', 'STORE_ID', 'PERANGKAT_UUID', 'KASIR_STT_NM', 'DOMPET_AUTODEBET_NM', 'PAYMENT_METHODE_NM', 'DATE_START', 'DATE_END', 'KONTRAK_DURASI', 'KONTRAK_DATE', 'CREATE_BY', 'UPDATE_BY', 'CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['KASIR_STT', 'DOMPET_AUTODEBET', 'PAYMENT_METHODE', 'PAKET_ID', 'STATUS'], 'integer'],
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
        $query = StoreKasir::find();

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
            'KASIR_STT' => $this->KASIR_STT,
            'DOMPET_AUTODEBET' => $this->DOMPET_AUTODEBET,
            'PAYMENT_METHODE' => $this->PAYMENT_METHODE,
            'PAKET_ID' => $this->PAKET_ID,
            'KONTRAK_DATE' => $this->KONTRAK_DATE,
            'STATUS' => $this->STATUS,
            'CREATE_AT' => $this->CREATE_AT,
            'UPDATE_AT' => $this->UPDATE_AT,
        ]);
        $query->andWhere(['NOT',['DATE_START' => NULL]]);
        $query->andWhere(['NOT',['DATE_END' => NULL]]);

        $query->andFilterWhere(['like', 'KASIR_ID', $this->KASIR_ID])
            ->andFilterWhere(['like', 'KASIR_NM', $this->KASIR_NM])
            ->andFilterWhere(['like', 'ACCESS_GROUP', $this->ACCESS_GROUP])
            ->andFilterWhere(['like', 'STORE_ID', $this->STORE_ID])
            ->andFilterWhere(['like', 'PERANGKAT_UUID', $this->PERANGKAT_UUID])
            ->andFilterWhere(['like', 'KASIR_STT_NM', $this->KASIR_STT_NM])
            ->andFilterWhere(['like', 'DOMPET_AUTODEBET_NM', $this->DOMPET_AUTODEBET_NM])
            ->andFilterWhere(['like', 'PAYMENT_METHODE_NM', $this->PAYMENT_METHODE_NM])
            ->andFilterWhere(['like', 'KONTRAK_DURASI', $this->KONTRAK_DURASI])
            ->andFilterWhere(['like', 'CREATE_BY', $this->CREATE_BY])
            ->andFilterWhere(['like', 'UPDATE_BY', $this->UPDATE_BY]);

        return $dataProvider;
    }
}
