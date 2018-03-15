<?php

namespace frontend\backend\master\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\backend\master\models\ProductStock;

/**
 * ProductStockSearch represents the model behind the search form of `frontend\backend\master\models\ProductStock`.
 */
class ProductStockSearch extends ProductStock
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'STATUS', 'YEAR_AT', 'MONTH_AT'], 'integer'],
            [['STOK_UNIK', 'ACCESS_GROUP', 'STORE_ID', 'PRODUCT_ID', 'SUPPLIER_ID', 'SUPPLIER_NM', 'INPUT_DATE', 'INPUT_TIME', 'CURRENT_DATE', 'CURRENT_TIME', 'CREATE_BY', 'CREATE_AT', 'UPDATE_BY', 'UPDATE_AT', 'CREATE_UUID', 'UPDATE_UUID', 'DCRP_DETIL'], 'safe'],
            [['LAST_STOCK', 'INPUT_STOCK', 'CURRENT_STOCK', 'SISA_STOCK'], 'number'],
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
        $query = ProductStock::find();
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
            'LAST_STOCK' => $this->LAST_STOCK,
            'INPUT_DATE' => $this->INPUT_DATE,
            'INPUT_TIME' => $this->INPUT_TIME,
            'INPUT_STOCK' => $this->INPUT_STOCK,
            'CURRENT_DATE' => $this->CURRENT_DATE,
            'CURRENT_TIME' => $this->CURRENT_TIME,
            'CURRENT_STOCK' => $this->CURRENT_STOCK,
            'SISA_STOCK' => $this->SISA_STOCK,
            'CREATE_AT' => $this->CREATE_AT,
            'UPDATE_AT' => $this->UPDATE_AT,
            'product_stock.STATUS' => 1,
            'product_stock.YEAR_AT' => $this->YEAR_AT,
            'product_stock.MONTH_AT' => $this->MONTH_AT,
        ]);


  
        $query->andFilterWhere(['like', 'product_stock.ACCESS_GROUP', $this->ACCESS_GROUP])
            ->andFilterWhere(['like', 'STORE_ID', $this->STORE_ID])
            ->andFilterWhere(['like', 'product_stock.PRODUCT_ID', $this->PRODUCT_ID])
            ->andFilterWhere(['like', 'CREATE_BY', $this->CREATE_BY])
            ->andFilterWhere(['like', 'UPDATE_BY', $this->UPDATE_BY])
            ->andFilterWhere(['like', 'SUPPLIER_ID', $this->SUPPLIER_ID])
            ->andFilterWhere(['like', 'SUPPLIER_NM', $this->SUPPLIER_NM])
            ->andFilterWhere(['like', 'CREATE_UUID', $this->CREATE_UUID])
            ->andFilterWhere(['like', 'UPDATE_UUID', $this->UPDATE_UUID])
            ->andFilterWhere(['like', 'DCRP_DETIL', $this->DCRP_DETIL])
            ->andFilterWhere(['between','product_stock.CREATE_AT',date('Y-m-d', strtotime('-10 month', strtotime(date('Y-m-d')))),date('Y-m-d', strtotime('+1 year', strtotime(date('Y-m-d'))))])
            ->andFilterWhere(['like', 'PRODUCT_NM', $this->PRODUCT_NM]);
            $query->orderBy(['CREATE_AT'=>SORT_DESC]);

        return $dataProvider;
    }
}
