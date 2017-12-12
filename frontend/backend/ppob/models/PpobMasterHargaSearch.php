<?php

namespace frontend\backend\ppob\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\backend\ppob\models\PpobMasterHarga;

/**
 * PpobMasterHargaSearch represents the model behind the search form about `frontend\backend\ppob\models\PpobMasterHarga`.
 */
class PpobMasterHargaSearch extends PpobMasterHarga
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'STATUS'], 'integer'],
            [['DETAIL_ID', 'KODE', 'KETERANGAN', 'NOMINAL', 'DCRIP', 'CREATE_BY', 'CREATE_AT', 'UPDATE_BY', 'UPDATE_AT'], 'safe'],
            [['HARGA1', 'HARGA2', 'HARGA3'], 'number'],
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
        $query = PpobMasterHarga::find();

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
            'HARGA1' => $this->HARGA1,
            'HARGA2' => $this->HARGA2,
            'HARGA3' => $this->HARGA3,
            'STATUS' => $this->STATUS,
            'CREATE_AT' => $this->CREATE_AT,
            'UPDATE_AT' => $this->UPDATE_AT,
        ]);

        $query->andFilterWhere(['like', 'DETAIL_ID', $this->DETAIL_ID])
            ->andFilterWhere(['like', 'KODE', $this->KODE])
            ->andFilterWhere(['like', 'KETERANGAN', $this->KETERANGAN])
            ->andFilterWhere(['like', 'NOMINAL', $this->NOMINAL])
            ->andFilterWhere(['like', 'DCRIP', $this->DCRIP])
            ->andFilterWhere(['like', 'CREATE_BY', $this->CREATE_BY])
            ->andFilterWhere(['like', 'UPDATE_BY', $this->UPDATE_BY]);

        return $dataProvider;
    }
}
