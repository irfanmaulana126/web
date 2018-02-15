<?php

namespace frontend\backend\payment\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\backend\payment\models\StoreInvoice;

/**
 * StoreInvoiceSearch represents the model behind the search form of `frontend\backend\payment\models\StoreInvoice`.
 */
class StoreInvoiceSearch extends StoreInvoice
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'STORE_STT', 'FAKTURE_TEMPO', 'PAYMENT_STT', 'PAYMENT_METHODE', 'DOMPET_AUTODEBET', 'PAKET_ID', 'PAKET_DURATION', 'PAKET_DURATION_BONUS'], 'integer'],
            [['ACCESS_GROUP', 'STORE_ID', 'KASIR_ID', 'STORE_STT_NM', 'STORE_DATE_END_LATES', 'STORE_DATE_START', 'STORE_DATE_END', 'FAKTURE_NO', 'FAKTURE_DATE_START', 'FAKTURE_DATE_END', 'PAYMENT_STT_NM', 'PAYMENT_DATE', 'PAYMENT_METHODE_NM', 'PAKET_GROUP', 'PAKET_NM', 'CREATE_BY', 'UPDATE_BY', 'CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['HARGA_BULAN', 'HARGA_HARI', 'HARGA_PAKET', 'HARGA_PAKET_HARI'], 'number'],
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
        $query = StoreInvoice::find();

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
            'STORE_STT' => $this->STORE_STT,
            'STORE_DATE_END_LATES' => $this->STORE_DATE_END_LATES,
            'STORE_DATE_START' => $this->STORE_DATE_START,
            'STORE_DATE_END' => $this->STORE_DATE_END,
            'FAKTURE_DATE_START' => $this->FAKTURE_DATE_START,
            'FAKTURE_TEMPO' => $this->FAKTURE_TEMPO,
            'FAKTURE_DATE_END' => $this->FAKTURE_DATE_END,
            'PAYMENT_STT' => $this->PAYMENT_STT,
            'PAYMENT_DATE' => $this->PAYMENT_DATE,
            'PAYMENT_METHODE' => $this->PAYMENT_METHODE,
            'DOMPET_AUTODEBET' => $this->DOMPET_AUTODEBET,
            'PAKET_ID' => $this->PAKET_ID,
            'PAKET_DURATION' => $this->PAKET_DURATION,
            'PAKET_DURATION_BONUS' => $this->PAKET_DURATION_BONUS,
            'HARGA_BULAN' => $this->HARGA_BULAN,
            'HARGA_HARI' => $this->HARGA_HARI,
            'HARGA_PAKET' => $this->HARGA_PAKET,
            'HARGA_PAKET_HARI' => $this->HARGA_PAKET_HARI,
            'CREATE_AT' => $this->CREATE_AT,
            'UPDATE_AT' => $this->UPDATE_AT,
        ]);

        $query->andFilterWhere(['like', 'ACCESS_GROUP', $this->ACCESS_GROUP])
            ->andFilterWhere(['like', 'STORE_ID', $this->STORE_ID])
            ->andFilterWhere(['like', 'KASIR_ID', $this->KASIR_ID])
            ->andFilterWhere(['like', 'STORE_STT_NM', $this->STORE_STT_NM])
            ->andFilterWhere(['like', 'FAKTURE_NO', $this->FAKTURE_NO])
            ->andFilterWhere(['like', 'PAYMENT_STT_NM', $this->PAYMENT_STT_NM])
            ->andFilterWhere(['like', 'PAYMENT_METHODE_NM', $this->PAYMENT_METHODE_NM])
            ->andFilterWhere(['like', 'PAKET_GROUP', $this->PAKET_GROUP])
            ->andFilterWhere(['like', 'PAKET_NM', $this->PAKET_NM])
            ->andFilterWhere(['like', 'CREATE_BY', $this->CREATE_BY])
            ->andFilterWhere(['like', 'UPDATE_BY', $this->UPDATE_BY]);

        return $dataProvider;
    }
}
