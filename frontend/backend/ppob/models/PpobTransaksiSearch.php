<?php

namespace frontend\backend\ppob\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\backend\ppob\models\PpobTransaksi;

/**
 * PpobTransaksiSearch represents the model behind the search form about `frontend\backend\ppob\models\PpobTransaksi`.
 */
class PpobTransaksiSearch extends PpobTransaksi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'QTY', 'STATUS'], 'integer'],
            [['TRANS_ID', 'TRANS_DATE', 'ACCESS_GROUP', 'STORE_ID', 'DETAIL_ID', 'KODE', 'NUMBER_ID', 'KETERANGAN', 'NOMINAL', 'CREATE_BY', 'CREATE_AT', 'UPDATE_BY', 'UPDATE_AT'], 'safe'],
            [['HARGA_KG', 'HARGA_JUAL'], 'number'],
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
        $query = PpobTransaksi::find();

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
            'TRANS_DATE' => $this->TRANS_DATE,
            'HARGA_KG' => $this->HARGA_KG,
            'HARGA_JUAL' => $this->HARGA_JUAL,
            'QTY' => $this->QTY,
            'STATUS' => $this->STATUS,
            'CREATE_AT' => $this->CREATE_AT,
            'UPDATE_AT' => $this->UPDATE_AT,
        ]);

        $query->andFilterWhere(['like', 'TRANS_ID', $this->TRANS_ID])
            ->andFilterWhere(['like', 'ACCESS_GROUP', $this->ACCESS_GROUP])
            ->andFilterWhere(['like', 'STORE_ID', $this->STORE_ID])
            ->andFilterWhere(['like', 'DETAIL_ID', $this->DETAIL_ID])
            ->andFilterWhere(['like', 'KODE', $this->KODE])
            ->andFilterWhere(['like', 'NUMBER_ID', $this->NUMBER_ID])
            ->andFilterWhere(['like', 'KETERANGAN', $this->KETERANGAN])
            ->andFilterWhere(['like', 'NOMINAL', $this->NOMINAL])
            ->andFilterWhere(['like', 'CREATE_BY', $this->CREATE_BY])
            ->andFilterWhere(['like', 'UPDATE_BY', $this->UPDATE_BY]);

        return $dataProvider;
    }
}
