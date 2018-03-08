<?php

namespace frontend\backend\laporan\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\backend\laporan\models\PtrKasirTd1;

/**
 * PtrKasirTd1Search represents the model behind the search form of `frontend\backend\laporan\models\PtrKasirTd1`.
 */
class PtrKasirTd1Search extends PtrKasirTd1
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TRANS_UNIK', 'ACCESS_GROUP', 'STORE_ID', 'ACCESS_ID', 'TRANS_ID', 'OFLINE_ID', 'TRANS_DATE', 'TYPE_PAY_NM', 'BANK_NM', 'PRODUCT_ID', 'PRODUCT_NM', 'PRODUCT_PROVIDER', 'PRODUCT_PROVIDER_NO', 'PRODUCT_PROVIDER_NM', 'UNIT_ID', 'UNIT_NM', 'CREATE_AT', 'UPDATE_BY', 'UPDATE_AT', 'DCRP_DETIL'], 'safe'],
            [['GOLONGAN', 'TRANS_TYPE', 'TYPE_PAY_ID', 'BANK_ID', 'STATUS', 'MONTH_AT', 'YEAR_AT'], 'integer'],
            [['PRODUCT_QTY', 'HPP', 'PPN', 'HARGA_JUAL', 'DISCOUNT', 'PROMO', 'JML_HPP', 'JML_DISCOUNT', 'JML_PPN', 'JML_HARGAJUAL', 'JML_JUALPPNDISCOUNT', 'JML_PROMO'], 'number'],
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
        $query = PtrKasirTd1::find();

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
            'GOLONGAN' => $this->GOLONGAN,
            // 'TRANS_DATE' => $this->TRANS_DATE,
            'TRANS_TYPE' => $this->TRANS_TYPE,
            'TYPE_PAY_ID' => $this->TYPE_PAY_ID,
            'BANK_ID' => $this->BANK_ID,
            'PRODUCT_QTY' => $this->PRODUCT_QTY,
            'HPP' => $this->HPP,
            'PPN' => $this->PPN,
            'HARGA_JUAL' => $this->HARGA_JUAL,
            'DISCOUNT' => $this->DISCOUNT,
            'PROMO' => $this->PROMO,
            'JML_HPP' => $this->JML_HPP,
            'JML_DISCOUNT' => $this->JML_DISCOUNT,
            'JML_PPN' => $this->JML_PPN,
            'JML_HARGAJUAL' => $this->JML_HARGAJUAL,
            'JML_JUALPPNDISCOUNT' => $this->JML_JUALPPNDISCOUNT,
            'JML_PROMO' => $this->JML_PROMO,
            'CREATE_AT' => $this->CREATE_AT,
            'UPDATE_AT' => $this->UPDATE_AT,
            'STATUS' => $this->STATUS,
            'MONTH_AT' => $this->MONTH_AT,
            'YEAR_AT' => $this->YEAR_AT,
        ]);

        $query->andFilterWhere(['like', 'TRANS_UNIK', $this->TRANS_UNIK])
            ->andFilterWhere(['like', 'ACCESS_GROUP', $this->ACCESS_GROUP])
            ->andFilterWhere(['like', 'TRANS_DATE', $this->TRANS_DATE])
            ->andFilterWhere(['like', 'STORE_ID', $this->STORE_ID])
            ->andFilterWhere(['like', 'ACCESS_ID', $this->ACCESS_ID])
            ->andFilterWhere(['like', 'TRANS_ID', $this->TRANS_ID])
            ->andFilterWhere(['like', 'OFLINE_ID', $this->OFLINE_ID])
            ->andFilterWhere(['like', 'TYPE_PAY_NM', $this->TYPE_PAY_NM])
            ->andFilterWhere(['like', 'BANK_NM', $this->BANK_NM])
            ->andFilterWhere(['like', 'PRODUCT_ID', $this->PRODUCT_ID])
            ->andFilterWhere(['like', 'PRODUCT_NM', $this->PRODUCT_NM])
            ->andFilterWhere(['like', 'PRODUCT_PROVIDER', $this->PRODUCT_PROVIDER])
            ->andFilterWhere(['like', 'PRODUCT_PROVIDER_NO', $this->PRODUCT_PROVIDER_NO])
            ->andFilterWhere(['like', 'PRODUCT_PROVIDER_NM', $this->PRODUCT_PROVIDER_NM])
            ->andFilterWhere(['like', 'UNIT_ID', $this->UNIT_ID])
            ->andFilterWhere(['like', 'UNIT_NM', $this->UNIT_NM])
            ->andFilterWhere(['like', 'UPDATE_BY', $this->UPDATE_BY])
            ->andFilterWhere(['like', 'DCRP_DETIL', $this->DCRP_DETIL]);

        return $dataProvider;
    }
}
