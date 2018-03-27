<?php

namespace frontend\backend\master\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\backend\master\models\Product;
use yii\data\ArrayDataProvider;

/**
 * ProductSearch represents the model behind the search form of `frontend\backend\master\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    
    
    public function rules()
    {
        return [
            [['ID', 'INDUSTRY_ID', 'INDUSTRY_GRP_ID', 'STATUS', 'YEAR_AT', 'MONTH_AT'], 'integer'],
            [['ACCESS_GROUP', 'STORE_ID', 'GROUP_ID', 'PRODUCT_ID', 'PRODUCT_QR', 'PRODUCT_NM', 'PRODUCT_WARNA', 'PRODUCT_SIZE_UNIT', 'PRODUCT_HEADLINE', 'UNIT_ID', 'INDUSTRY_NM', 'INDUSTRY_GRP_NM', 'IMG_FILE', 'CREATE_BY', 'CREATE_AT', 'UPDATE_BY', 'UPDATE_AT', 'CREATE_UUID', 'UPDATE_UUID', 'DCRP_DETIL'], 'safe'],
            [['PRODUCT_SIZE', 'STOCK_LEVEL', 'CURRENT_STOCK', 'CURRENT_HPP', 'CURRENT_PPN','CURRENT_PRICE'], 'number'],
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
        $query = Product::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
				'pageSize' => 100,
			]
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
            'PRODUCT_SIZE' => $this->PRODUCT_SIZE,
            'STOCK_LEVEL' => $this->STOCK_LEVEL,
            'CURRENT_STOCK' => $this->CURRENT_STOCK,
            'CURRENT_HPP' => $this->CURRENT_HPP,
            'CURRENT_PRICE' => $this->CURRENT_PRICE,
            'CURRENT_PPN' => $this->CURRENT_PPN,
            'INDUSTRY_ID' => $this->INDUSTRY_ID,
            'INDUSTRY_GRP_ID' => $this->INDUSTRY_GRP_ID,
            'CREATE_AT' => $this->CREATE_AT,
            'UPDATE_AT' => $this->UPDATE_AT,
            'STATUS' => 1,
            'YEAR_AT' => $this->YEAR_AT,
            'MONTH_AT' => $this->MONTH_AT,
        ]);

        $query->andFilterWhere(['like', 'ACCESS_GROUP', $this->ACCESS_GROUP])
            ->andFilterWhere(['like', 'STORE_ID', $this->STORE_ID])
            ->andFilterWhere(['like', 'GROUP_ID', $this->GROUP_ID])
            ->andFilterWhere(['like', 'PRODUCT_ID', $this->PRODUCT_ID])
            ->andFilterWhere(['like', 'PRODUCT_QR', $this->PRODUCT_QR])
            ->andFilterWhere(['like', 'PRODUCT_NM', $this->PRODUCT_NM])
            ->andFilterWhere(['like', 'PRODUCT_WARNA', $this->PRODUCT_WARNA])
            ->andFilterWhere(['like', 'PRODUCT_SIZE_UNIT', $this->PRODUCT_SIZE_UNIT])
            ->andFilterWhere(['like', 'PRODUCT_HEADLINE', $this->PRODUCT_HEADLINE])
            ->andFilterWhere(['like', 'UNIT_ID', $this->UNIT_ID])
            ->andFilterWhere(['like', 'INDUSTRY_NM', $this->INDUSTRY_NM])
            ->andFilterWhere(['like', 'INDUSTRY_GRP_NM', $this->INDUSTRY_GRP_NM])
            ->andFilterWhere(['like', 'IMG_FILE', $this->IMG_FILE])
            ->andFilterWhere(['like', 'CREATE_BY', $this->CREATE_BY])
            ->andFilterWhere(['like', 'UPDATE_BY', $this->UPDATE_BY])
            ->andFilterWhere(['like', 'CREATE_UUID', $this->CREATE_UUID])
            ->andFilterWhere(['like', 'UPDATE_UUID', $this->UPDATE_UUID])
            ->andFilterWhere(['like', 'DCRP_DETIL', $this->DCRP_DETIL]);
            $query->orderBy(['PRODUCT_ID'=>SORT_DESC,'STORE_ID'=>SORT_DESC]);
            $query->groupBy([
                'PRODUCT_ID'
            ]);
        return $dataProvider;
    }
    public function getStore()
    {
            return $this->hasOne(Store::className(),['STORE_ID'=>'STORE_ID']);
        
    }
    public function searchExcelExport($params)
    {
        $query = "SELECT `PRODUCT_ID`,`PRODUCT_NM`,`PRODUCT_QR`,`PRODUCT_WARNA`,`PRODUCT_HEADLINE`,`DCRP_DETIL`FROM product WHERE ACCESS_GROUP=".Yii::$app->user->identity->ACCESS_GROUP." AND STATUS='1' ORDER BY STORE_ID DESC";
       $qrySql= Yii::$app->db->createCommand($query)->queryAll();
        $dataProvider = new ArrayDataProvider([
            'allModels' => $qrySql,
        ]);

        return $dataProvider;
    }
    
}
