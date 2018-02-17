<?php

namespace frontend\backend\payment\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\backend\payment\models\DompetSaldo;

/**
 * DompetSaldoSearch represents the model behind the search form of `frontend\backend\payment\models\DompetSaldo`.
 */
class DompetSaldoSearch extends DompetSaldo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ACCESS_GROUP', 'VA_ID', 'CURRENT_TGL', 'TGL', 'WAKTU', 'CREATE_BY', 'CREATE_AT', 'UPDATE_BY', 'UPDATE_AT'], 'safe'],
            [['SALDO_DOMPET', 'SALDO_MENEGNDAP', 'SALDO_JUALAN'], 'number'],
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
        $query = DompetSaldo::find();

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
            'SALDO_DOMPET' => $this->SALDO_DOMPET,
            'SALDO_MENEGNDAP' => $this->SALDO_MENEGNDAP,
            'SALDO_JUALAN' => $this->SALDO_JUALAN,
            'CURRENT_TGL' => $this->CURRENT_TGL,
            'TGL' => $this->TGL,
            'WAKTU' => $this->WAKTU,
            'CREATE_AT' => $this->CREATE_AT,
            'UPDATE_AT' => $this->UPDATE_AT,
        ]);

        $query->andFilterWhere(['like', 'ACCESS_GROUP', $this->ACCESS_GROUP])
            ->andFilterWhere(['like', 'VA_ID', $this->VA_ID])
            ->andFilterWhere(['like', 'CREATE_BY', $this->CREATE_BY])
            ->andFilterWhere(['like', 'UPDATE_BY', $this->UPDATE_BY]);

        return $dataProvider;
    }
}
