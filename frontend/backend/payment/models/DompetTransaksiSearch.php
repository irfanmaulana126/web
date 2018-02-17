<?php

namespace frontend\backend\payment\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\backend\payment\models\DompetTransaksi;

/**
 * DompetTransaksiSearch represents the model behind the search form of `frontend\backend\payment\models\DompetTransaksi`.
 */
class DompetTransaksiSearch extends DompetTransaksi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TRANS_ID', 'STORE_ID', 'ACCESS_GROUP', 'VA_ID', 'TRANSCODE', 'TRANSCODE_NM', 'TRANS_TYPE_NM', 'CURRENT_TGL', 'TGL', 'WAKTU', 'REF_NUMBER', 'CREATE_BY', 'CREATE_AT', 'UPDATE_BY', 'UPDATE_AT'], 'safe'],
            [['TRANS_TYPE'], 'integer'],
            [['JUMLAH'], 'number'],
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
        $query = DompetTransaksi::find();

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
            'TRANS_TYPE' => $this->TRANS_TYPE,
            'JUMLAH' => $this->JUMLAH,
            'CURRENT_TGL' => $this->CURRENT_TGL,
            'TGL' => $this->TGL,
            'WAKTU' => $this->WAKTU,
            'CREATE_AT' => $this->CREATE_AT,
            'UPDATE_AT' => $this->UPDATE_AT,
        ]);

        $query->andFilterWhere(['like', 'TRANS_ID', $this->TRANS_ID])
            ->andFilterWhere(['like', 'STORE_ID', $this->STORE_ID])
            ->andFilterWhere(['like', 'ACCESS_GROUP', $this->ACCESS_GROUP])
            ->andFilterWhere(['like', 'VA_ID', $this->VA_ID])
            ->andFilterWhere(['like', 'TRANSCODE', $this->TRANSCODE])
            ->andFilterWhere(['like', 'TRANSCODE_NM', $this->TRANSCODE_NM])
            ->andFilterWhere(['like', 'TRANS_TYPE_NM', $this->TRANS_TYPE_NM])
            ->andFilterWhere(['like', 'REF_NUMBER', $this->REF_NUMBER])
            ->andFilterWhere(['like', 'CREATE_BY', $this->CREATE_BY])
            ->andFilterWhere(['like', 'UPDATE_BY', $this->UPDATE_BY]);

        return $dataProvider;
    }
}
