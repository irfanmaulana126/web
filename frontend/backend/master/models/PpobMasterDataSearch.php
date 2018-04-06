<?php

namespace frontend\backend\master\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\backend\master\models\PpobMasterData;

/**
 * PpobMasterDataSearch represents the model behind the search form of `frontend\backend\master\models\PpobMasterData`.
 */
class PpobMasterDataSearch extends PpobMasterData
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID_PRODUK', 'TYPE_NM', 'KELOMPOK', 'KTG_ID', 'KTG_NM', 'ID_CODE', 'CODE', 'NAME', 'FUNGSI', 'KETERANGAN', 'CREATE_BY', 'CREATE_AT', 'UPDATE_BY', 'UPDATE_AT'], 'safe'],
            [['DENOM', 'HARGA'], 'number'],
            [['PERMIT', 'STATUS'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = PpobMasterData::find();

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
            'DENOM' => $this->DENOM,
            'HARGA' => $this->HARGA,
            'PERMIT' => $this->PERMIT,
            'STATUS' => $this->STATUS,
            'CREATE_AT' => $this->CREATE_AT,
            'UPDATE_AT' => $this->UPDATE_AT,
        ]);

        $query->andFilterWhere(['like', 'ID_PRODUK', $this->ID_PRODUK])
            ->andFilterWhere(['like', 'TYPE_NM', $this->TYPE_NM])
            ->andFilterWhere(['like', 'KELOMPOK', $this->KELOMPOK])
            ->andFilterWhere(['like', 'KTG_ID', $this->KTG_ID])
            ->andFilterWhere(['like', 'KTG_NM', $this->KTG_NM])
            ->andFilterWhere(['like', 'ID_CODE', $this->ID_CODE])
            ->andFilterWhere(['like', 'CODE', $this->CODE])
            ->andFilterWhere(['like', 'NAME', $this->NAME])
            ->andFilterWhere(['like', 'FUNGSI', $this->FUNGSI])
            ->andFilterWhere(['like', 'KETERANGAN', $this->KETERANGAN])
            ->andFilterWhere(['like', 'CREATE_BY', $this->CREATE_BY])
            ->andFilterWhere(['like', 'UPDATE_BY', $this->UPDATE_BY]);

        return $dataProvider;
    }
}
