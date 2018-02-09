<?php

namespace frontend\backend\sistem\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\backend\sistem\models\Store;

/**
 * StoreSearch represents the model behind the search form of `frontend\backend\sistem\models\Store`.
 */
class StoreSearch extends Store
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'PROVINCE_ID', 'CITY_ID', 'INDUSTRY_ID', 'INDUSTRY_GRP_ID', 'STATUS', 'YEAR_AT', 'MONTH_AT'], 'integer'],
            [['ACCESS_GROUP', 'STORE_ID', 'STORE_NM', 'ACCESS_ID', 'UUID', 'PLAYER_ID', 'DATE_START', 'DATE_END', 'PROVINCE_NM', 'CITY_NAME', 'ALAMAT', 'PIC', 'TLP', 'FAX', 'INDUSTRY_NM', 'INDUSTRY_GRP_NM', 'CREATE_BY', 'CREATE_AT', 'UPDATE_BY', 'UPDATE_AT', 'DCRP_DETIL'], 'safe'],
            [['LATITUDE', 'LONGITUDE', 'PPN'], 'number'],
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
        $query = Store::find();

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
            'DATE_START' => $this->DATE_START,
            'DATE_END' => $this->DATE_END,
            'PROVINCE_ID' => $this->PROVINCE_ID,
            'CITY_ID' => $this->CITY_ID,
            'LATITUDE' => $this->LATITUDE,
            'LONGITUDE' => $this->LONGITUDE,
            'PPN' => $this->PPN,
            'INDUSTRY_ID' => $this->INDUSTRY_ID,
            'INDUSTRY_GRP_ID' => $this->INDUSTRY_GRP_ID,
            'CREATE_AT' => $this->CREATE_AT,
            'UPDATE_AT' => $this->UPDATE_AT,
            'STATUS' => $this->STATUS,
            'YEAR_AT' => $this->YEAR_AT,
            'MONTH_AT' => $this->MONTH_AT,
        ]);

        $query->andFilterWhere(['like', 'ACCESS_GROUP', $this->ACCESS_GROUP])
            ->andFilterWhere(['like', 'STORE_ID', $this->STORE_ID])
            ->andFilterWhere(['like', 'STORE_NM', $this->STORE_NM])
            ->andFilterWhere(['like', 'ACCESS_ID', $this->ACCESS_ID])
            ->andFilterWhere(['like', 'UUID', $this->UUID])
            ->andFilterWhere(['like', 'PLAYER_ID', $this->PLAYER_ID])
            ->andFilterWhere(['like', 'PROVINCE_NM', $this->PROVINCE_NM])
            ->andFilterWhere(['like', 'CITY_NAME', $this->CITY_NAME])
            ->andFilterWhere(['like', 'ALAMAT', $this->ALAMAT])
            ->andFilterWhere(['like', 'PIC', $this->PIC])
            ->andFilterWhere(['like', 'TLP', $this->TLP])
            ->andFilterWhere(['like', 'FAX', $this->FAX])
            ->andFilterWhere(['like', 'INDUSTRY_NM', $this->INDUSTRY_NM])
            ->andFilterWhere(['like', 'INDUSTRY_GRP_NM', $this->INDUSTRY_GRP_NM])
            ->andFilterWhere(['like', 'CREATE_BY', $this->CREATE_BY])
            ->andFilterWhere(['like', 'UPDATE_BY', $this->UPDATE_BY])
            ->andFilterWhere(['like', 'DCRP_DETIL', $this->DCRP_DETIL]);

        return $dataProvider;
    }
}
