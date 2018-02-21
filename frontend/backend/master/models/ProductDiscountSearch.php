<?php

namespace frontend\backend\master\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\backend\master\models\ProductDiscount;

/**
 * ProductDiscountSearch represents the model behind the search form of `frontend\backend\master\models\ProductDiscount`.
 */
class ProductDiscountSearch extends ProductDiscount
{
    /**
     * @inheritdoc
     */
    public $PRODUCT_NM;
    public function rules()
    {
        return [
            [['ID', 'STATUS', 'YEAR_AT', 'MONTH_AT'], 'integer'],
            [['ACCESS_GROUP', 'PRODUCT_NM','STORE_ID', 'PRODUCT_ID', 'PERIODE_TGL1', 'PERIODE_TGL2', 'START_TIME', 'CREATE_BY', 'CREATE_AT', 'UPDATE_BY', 'UPDATE_AT', 'DCRP_DETIL'], 'safe'],
            [['DISCOUNT'], 'number'],
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
        $query = ProductDiscount::find();
        $query->joinWith(['product']);

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
            'PERIODE_TGL1' => $this->PERIODE_TGL1,
            'PERIODE_TGL2' => $this->PERIODE_TGL2,
            'START_TIME' => $this->START_TIME,
            'DISCOUNT' => $this->DISCOUNT,
            'CREATE_AT' => $this->CREATE_AT,
            'UPDATE_AT' => $this->UPDATE_AT,
            'product_discount.STATUS' => 1,
            'product_discount.YEAR_AT' => $this->YEAR_AT,
            'product_discount.MONTH_AT' => $this->MONTH_AT,
        ]);

        $query->andFilterWhere(['like', 'product_discount.ACCESS_GROUP', $this->ACCESS_GROUP])
            ->andFilterWhere(['like', 'product_discount.STORE_ID', $this->STORE_ID])
            ->andFilterWhere(['like', 'product_discount.PRODUCT_ID', $this->PRODUCT_ID])
            ->andFilterWhere(['like', 'CREATE_BY', $this->CREATE_BY])
            ->andFilterWhere(['like', 'UPDATE_BY', $this->UPDATE_BY])
            ->andFilterWhere(['like', 'DCRP_DETIL', $this->DCRP_DETIL])
            ->andFilterWhere(['like', 'product_discount.PRODUCT_ID', $this->PRODUCT_NM]);

        return $dataProvider;
    }
}
