<?php

namespace frontend\backend\laporan\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\backend\laporan\models\TransPenjualanHeaderSummaryDailyHour;

/**
 * TransPenjualanHeaderSummaryDailyHourSearch represents the model behind the search form about `frontend\backend\laporan\models\TransPenjualanHeaderSummaryDailyHour`.
 */
class TransPenjualanHeaderSummaryDailyHourSearch extends TransPenjualanHeaderSummaryDailyHour
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'BULAN', 'VAL1', 'VAL2', 'VAL3', 'VAL4', 'VAL5', 'VAL6', 'VAL7', 'VAL8', 'VAL9', 'VAL10', 'VAL11', 'VAL12', 'VAL13', 'VAL14', 'VAL15', 'VAL16', 'VAL17', 'VAL18', 'VAL19', 'VAL20', 'VAL21', 'VAL22', 'VAL23', 'VAL24'], 'integer'],
            [['ACCESS_GROUP', 'STORE_ID', 'TAHUN', 'TGL', 'CREATE_AT', 'UPDATE_AT', 'KETERANGAN'], 'safe'],
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
        $query = TransPenjualanHeaderSummaryDailyHour::find();

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
            'BULAN' => $this->BULAN,
            'TGL' => $this->TGL,
            'VAL1' => $this->VAL1,
            'VAL2' => $this->VAL2,
            'VAL3' => $this->VAL3,
            'VAL4' => $this->VAL4,
            'VAL5' => $this->VAL5,
            'VAL6' => $this->VAL6,
            'VAL7' => $this->VAL7,
            'VAL8' => $this->VAL8,
            'VAL9' => $this->VAL9,
            'VAL10' => $this->VAL10,
            'VAL11' => $this->VAL11,
            'VAL12' => $this->VAL12,
            'VAL13' => $this->VAL13,
            'VAL14' => $this->VAL14,
            'VAL15' => $this->VAL15,
            'VAL16' => $this->VAL16,
            'VAL17' => $this->VAL17,
            'VAL18' => $this->VAL18,
            'VAL19' => $this->VAL19,
            'VAL20' => $this->VAL20,
            'VAL21' => $this->VAL21,
            'VAL22' => $this->VAL22,
            'VAL23' => $this->VAL23,
            'VAL24' => $this->VAL24,
            'CREATE_AT' => $this->CREATE_AT,
            'UPDATE_AT' => $this->UPDATE_AT,
        ]);

        $query->andFilterWhere(['like', 'ACCESS_GROUP', $this->ACCESS_GROUP])
            ->andFilterWhere(['like', 'STORE_ID', $this->STORE_ID])
            ->andFilterWhere(['like', 'TAHUN', $this->TAHUN])
            ->andFilterWhere(['like', 'KETERANGAN', $this->KETERANGAN]);

        return $dataProvider;
    }
}
