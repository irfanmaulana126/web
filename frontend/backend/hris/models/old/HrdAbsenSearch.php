<?php

namespace frontend\backend\hris\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\backend\hris\models\HrdAbsen;

/**
 * HrdAbsenSearch represents the model behind the search form about `frontend\backend\hris\models\HrdAbsen`.
 */
class HrdAbsenSearch extends HrdAbsen
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'ABSEN_ID', 'STATUS', 'YEAR_AT', 'MONTH_AT'], 'integer'],
            [['OFLINE_ID', 'ACCESS_GROUP', 'STORE_ID', 'KARYAWAN_ID', 'TGL', 'WAKTU', 'CREATE_BY', 'CREATE_AT', 'UPDATE_BY', 'UPDATE_AT', 'DCRP_DETIL'], 'safe'],
            [['LATITUDE', 'LONGITUDE'], 'number'],
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
        $query = HrdAbsen::find();

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
            'ABSEN_ID' => $this->ABSEN_ID,
            'TGL' => $this->TGL,
            'WAKTU' => $this->WAKTU,
            'LATITUDE' => $this->LATITUDE,
            'LONGITUDE' => $this->LONGITUDE,
            'CREATE_AT' => $this->CREATE_AT,
            'UPDATE_AT' => $this->UPDATE_AT,
            'STATUS' => $this->STATUS,
            'YEAR_AT' => $this->YEAR_AT,
            'MONTH_AT' => $this->MONTH_AT,
        ]);

        $query->andFilterWhere(['like', 'OFLINE_ID', $this->OFLINE_ID])
            ->andFilterWhere(['like', 'ACCESS_GROUP', $this->ACCESS_GROUP])
            ->andFilterWhere(['like', 'STORE_ID', $this->STORE_ID])
            ->andFilterWhere(['like', 'KARYAWAN_ID', $this->KARYAWAN_ID])
            ->andFilterWhere(['like', 'CREATE_BY', $this->CREATE_BY])
            ->andFilterWhere(['like', 'UPDATE_BY', $this->UPDATE_BY])
            ->andFilterWhere(['like', 'DCRP_DETIL', $this->DCRP_DETIL]);

        return $dataProvider;
    }
}
