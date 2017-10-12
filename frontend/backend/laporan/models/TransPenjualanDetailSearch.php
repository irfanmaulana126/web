<?php

namespace frontend\backend\laporan\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\backend\laporan\models\TransPenjualanDetail;

/**
 * TransPenjualanDetailSearch represents the model behind the search form about `frontend\backend\laporan\models\TransPenjualanDetail`.
 */
class TransPenjualanDetailSearch extends TransPenjualanDetail
{
	/* public function attributes()
	{
		return array_merge(parent::attributes(), [
			'opencloseId','ppn','totalHarga','merchantId','typaPayId','typePayNm','bankId','typePayNm','bankId','bankNm',
			'merchantNm','merchantNo','customerId','customerNm','customerEmail','customerPhone','storeNm'
		]);
	} */
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'GOLONGAN', 'STATUS', 'YEAR_AT', 'MONTH_AT'], 'integer'],
            [['ACCESS_GROUP', 'STORE_ID', 'ACCESS_ID', 'TRANS_ID', 'OFLINE_ID', 'TRANS_DATE', 'PRODUCT_ID', 'PRODUCT_NM', 'PRODUCT_PROVIDER', 'PRODUCT_PROVIDER_NO', 'PRODUCT_PROVIDER_NM', 'UNIT_ID', 'UNIT_NM', 'PROMO', 'CREATE_AT', 'UPDATE_BY', 'UPDATE_AT', 'DCRP_DETIL'], 'safe'],
            [['PRODUCT_QTY', 'HARGA_JUAL', 'DISCOUNT'], 'number'],
			// [['opencloseId','ppn','totalHarga','merchantId','typaPayId','typePayNm','bankId','typePayNm','bankId','bankNm',
			// 'merchantNm','merchantNo','customerId','customerNm','customerEmail','customerPhone','storeNm'],'safe'],
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
        $query = TransPenjualanDetail::find()->where(['ACCESS_GROUP'=>Yii::$app->getUserOpt->user()['ACCESS_GROUP']]);

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
            'TRANS_ID' => $this->TRANS_ID,
            'GOLONGAN' => $this->GOLONGAN,
            'ACCESS_GROUP' => $this->ACCESS_GROUP,
            'STORE_ID' => $this->STORE_ID,
            'PRODUCT_QTY' => $this->PRODUCT_QTY,
            'HARGA_JUAL' => $this->HARGA_JUAL,
            'DISCOUNT' => $this->DISCOUNT,
            'CREATE_AT' => $this->CREATE_AT,
            'UPDATE_AT' => $this->UPDATE_AT,
            'STATUS' => $this->STATUS,
            'YEAR_AT' => $this->YEAR_AT,
            'MONTH_AT' => $this->MONTH_AT,
        ]);

        $query->andFilterWhere(['like', 'ACCESS_ID', $this->ACCESS_ID])
           ->andFilterWhere(['like', 'TRANS_DATE', date("Y-m-d",strtotime($this->TRANS_DATE))])
            // ->andFilterWhere(['like', 'TRANS_DATE', $this->TRANS_DATE])
            ->andFilterWhere(['like', 'OFLINE_ID', $this->OFLINE_ID])
            ->andFilterWhere(['like', 'PRODUCT_ID', $this->PRODUCT_ID])
            ->andFilterWhere(['like', 'PRODUCT_NM', $this->PRODUCT_NM])
            ->andFilterWhere(['like', 'PRODUCT_PROVIDER', $this->PRODUCT_PROVIDER])
            ->andFilterWhere(['like', 'PRODUCT_PROVIDER_NO', $this->PRODUCT_PROVIDER_NO])
            ->andFilterWhere(['like', 'PRODUCT_PROVIDER_NM', $this->PRODUCT_PROVIDER_NM])
            ->andFilterWhere(['like', 'UNIT_ID', $this->UNIT_ID])
            ->andFilterWhere(['like', 'UNIT_NM', $this->UNIT_NM])
            ->andFilterWhere(['like', 'PROMO', $this->PROMO])
            ->andFilterWhere(['like', 'UPDATE_BY', $this->UPDATE_BY])
            ->andFilterWhere(['like', 'DCRP_DETIL', $this->DCRP_DETIL]);

        return $dataProvider;
    }
}
