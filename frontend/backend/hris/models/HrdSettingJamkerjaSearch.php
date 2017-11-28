<?php

namespace frontend\backend\hris\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\backend\hris\models\HrdSettingJamkerja;

/**
 * HrdSettingJamkerjaSearch represents the model behind the search form about `frontend\backend\hris\models\HrdSettingJamkerja`.
 */
class HrdSettingJamkerjaSearch extends HrdSettingJamkerja
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'SHIFT_ID', 'SEQ', 'RADIUS_KOORDINAT', 'TOLERANSI_TELAT', 'TOLERANSI_PULANG', 'STATUS', 'YEAR_AT', 'MONTH_AT'], 'integer'],
            [['ACCESS_GROUP', 'STORE_ID', 'SHIFT_NM', 'JAM_IN', 'JAM_OUT', 'CREATE_BY', 'CREATE_AT', 'UPDATE_BY', 'UPDATE_AT', 'DCRP_DETIL'], 'safe'],
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
        $query = HrdSettingJamkerja::find();

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
            'SHIFT_ID' => $this->SHIFT_ID,
            'JAM_IN' => $this->JAM_IN,
            'JAM_OUT' => $this->JAM_OUT,
            'SEQ' => $this->SEQ,
            'RADIUS_KOORDINAT' => $this->RADIUS_KOORDINAT,
            'TOLERANSI_TELAT' => $this->TOLERANSI_TELAT,
            'TOLERANSI_PULANG' => $this->TOLERANSI_PULANG,
            'CREATE_AT' => $this->CREATE_AT,
            'UPDATE_AT' => $this->UPDATE_AT,
            'STATUS' => $this->STATUS,
            'YEAR_AT' => $this->YEAR_AT,
            'MONTH_AT' => $this->MONTH_AT,
        ]);

        $query->andFilterWhere(['like', 'ACCESS_GROUP', $this->ACCESS_GROUP])
            ->andFilterWhere(['like', 'STORE_ID', $this->STORE_ID])
            ->andFilterWhere(['like', 'SHIFT_NM', $this->SHIFT_NM])
            ->andFilterWhere(['like', 'CREATE_BY', $this->CREATE_BY])
            ->andFilterWhere(['like', 'UPDATE_BY', $this->UPDATE_BY])
            ->andFilterWhere(['like', 'DCRP_DETIL', $this->DCRP_DETIL]);

        return $dataProvider;
    }
}
