<?php

namespace frontend\backend\laporan\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\backend\laporan\models\PtrKasirTd1c;

/**
 * PtrKasirTd1cSearch represents the model behind the search form of `frontend\backend\laporan\models\PtrKasirTd1c`.
 */
class PtrKasirTd1cSearch extends PtrKasirTd1c
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TRANS_MONTH', 'ACCESS_GROUP', 'STORE_ID', 'TRANS_DATE', 'TAHUN', 'PRODUCT_ID', 'PRODUCT_NM', 'PRODUCT_PROVIDER', 'PRODUCT_PROVIDER_NO', 'PRODUCT_PROVIDER_NM', 'UNIT_NM', 'CREATE_AT', 'UPDATE_AT'], 'safe'],
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

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = PtrKasirTd1c::find();

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

        $query->andFilterWhere(['like', 'TRANS_MONTH', $this->TRANS_MONTH])
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
