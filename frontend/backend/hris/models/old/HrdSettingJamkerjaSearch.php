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
            [['ID', 'SHIFT_ID', 'SHIFT_IN_BATAS_SEQ', 'SHIFT_SEQ', 'RADIUS_KOORDINAT', 'TOLERANSI_TELAT', 'TOLERANSI_PULANG', 'STATUS', 'YEAR_AT', 'MONTH_AT'], 'integer'],
            [['ACCESS_GROUP', 'STORE_ID', 'SHIFT_NM', 'RENTANG_BAWAH', 'RENTANG_ATAS', 'RENTANG_TENGAH', 'SHIFT_IN_BATAS_BAWAH', 'SHIFT_IN_BATAS_ATAS', 'SHIFT_IN', 'SHIFT_OUT', 'CREATE_BY', 'CREATE_AT', 'UPDATE_BY', 'UPDATE_AT', 'DCRP_DETIL'], 'safe'],
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
            'RENTANG_BAWAH' => $this->RENTANG_BAWAH,
            'RENTANG_ATAS' => $this->RENTANG_ATAS,
            'RENTANG_TENGAH' => $this->RENTANG_TENGAH,
            'SHIFT_IN_BATAS_BAWAH' => $this->SHIFT_IN_BATAS_BAWAH,
            'SHIFT_IN_BATAS_SEQ' => $this->SHIFT_IN_BATAS_SEQ,
            'SHIFT_IN_BATAS_ATAS' => $this->SHIFT_IN_BATAS_ATAS,
            'SHIFT_IN' => $this->SHIFT_IN,
            'SHIFT_OUT' => $this->SHIFT_OUT,
            'SHIFT_SEQ' => $this->SHIFT_SEQ,
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
