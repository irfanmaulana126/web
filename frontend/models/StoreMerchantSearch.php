<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\StoreMerchant;

/**
 * StoreMerchantSearch represents the model behind the search form about `frontend\models\StoreMerchant`.
 */
class StoreMerchantSearch extends StoreMerchant
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'TYPE_PAY', 'STATUS', 'YEAR_AT', 'MONTH_AT'], 'integer'],
            [['ACCESS_GROUP', 'STORE_ID', 'BANK_NM', 'MERCHANT_NM', 'MERCHANT_NO', 'MERCHANT_TOKEN', 'MERCHANT_URL', 'CREATE_BY', 'CREATE_AT', 'UPDATE_BY', 'UPDATE_AT', 'DCRP_DETIL'], 'safe'],
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
        $query = StoreMerchant::find();

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
            'TYPE_PAY' => $this->TYPE_PAY,
            'CREATE_AT' => $this->CREATE_AT,
            'UPDATE_AT' => $this->UPDATE_AT,
            'STATUS' => $this->STATUS,
            'YEAR_AT' => $this->YEAR_AT,
            'MONTH_AT' => $this->MONTH_AT,
        ]);

        $query->andFilterWhere(['like', 'ACCESS_GROUP', $this->ACCESS_GROUP])
            ->andFilterWhere(['like', 'STORE_ID', $this->STORE_ID])
            ->andFilterWhere(['like', 'BANK_NM', $this->BANK_NM])
            ->andFilterWhere(['like', 'MERCHANT_NM', $this->MERCHANT_NM])
            ->andFilterWhere(['like', 'MERCHANT_NO', $this->MERCHANT_NO])
            ->andFilterWhere(['like', 'MERCHANT_TOKEN', $this->MERCHANT_TOKEN])
            ->andFilterWhere(['like', 'MERCHANT_URL', $this->MERCHANT_URL])
            ->andFilterWhere(['like', 'CREATE_BY', $this->CREATE_BY])
            ->andFilterWhere(['like', 'UPDATE_BY', $this->UPDATE_BY])
            ->andFilterWhere(['like', 'DCRP_DETIL', $this->DCRP_DETIL]);

        return $dataProvider;
    }
}
