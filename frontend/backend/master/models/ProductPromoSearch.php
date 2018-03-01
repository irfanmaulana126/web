<?php

namespace frontend\backend\master\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\backend\master\models\ProductPromo;

/**
 * ProductPromoSearch represents the model behind the search form of `frontend\backend\master\models\ProductPromo`.
 */
class ProductPromoSearch extends ProductPromo
{
    /**
     * @inheritdoc
     */
    public $PRODUCT_NM;
    public function rules()
    {
        return [
            [['ID', 'STATUS', 'YEAR_AT', 'MONTH_AT'], 'integer'],
            [['ACCESS_GROUP', 'PRODUCT_NM','STORE_ID', 'PRODUCT_ID', 'PERIODE_TGL1', 'PERIODE_TGL2', 'START_TIME', 'PROMO', 'CREATE_BY', 'CREATE_AT', 'UPDATE_BY', 'UPDATE_AT', 'DCRP_DETIL'], 'safe'],
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
        $query = ProductPromo::find();
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
            'CREATE_AT' => $this->CREATE_AT,
            'UPDATE_AT' => $this->UPDATE_AT,
            'product_promo.STATUS' => 1,
            'YEAR_AT' => $this->YEAR_AT,
            'MONTH_AT' => $this->MONTH_AT,
        ]);

        $query->andFilterWhere(['like', 'product_promo.ACCESS_GROUP', $this->ACCESS_GROUP])
            ->andFilterWhere(['like', 'product_promo.STORE_ID', $this->STORE_ID])
            ->andFilterWhere(['like', 'product_promo.PRODUCT_ID', $this->PRODUCT_ID])
            ->andFilterWhere(['like', 'PROMO', $this->PROMO])
            ->andFilterWhere(['like', 'CREATE_BY', $this->CREATE_BY])
            ->andFilterWhere(['like', 'UPDATE_BY', $this->UPDATE_BY])
            ->andFilterWhere(['like', 'DCRP_DETIL', $this->DCRP_DETIL])
            ->andFilterWhere(['between','product_promo.CREATE_AT',date('Y-m-d', strtotime('-10 month', strtotime(date('Y-m-d')))),date('Y-m-d', strtotime('+1 year', strtotime(date('Y-m-d'))))])
            ->andFilterWhere(['like', 'product_promo.PRODUCT_NM', $this->PRODUCT_NM]);
            $query->orderBy(['CREATE_AT'=>SORT_DESC]);
        return $dataProvider;
    }
}
