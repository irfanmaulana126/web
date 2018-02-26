<?php

namespace frontend\backend\master\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\backend\master\models\StoreMembershipPaket;

/**
 * StoreMembershipPaketSearch represents the model behind the search form of `frontend\backend\master\models\StoreMembershipPaket`.
 */
class StoreMembershipPaketSearch extends StoreMembershipPaket
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PAKET_ID', 'PAKET_DURATION', 'PAKET_DURATION_BONUS', 'PAKET_STT'], 'integer'],
            [['PAKET_GROUP', 'PAKET_NM', 'PAKET_STT_NM', 'CREATE_BY', 'UPDATE_BY', 'CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['HARGA_BULAN', 'HARGA_HARI', 'HARGA_PAKET', 'HARGA_PAKET_HARI'], 'number'],
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
        $query = StoreMembershipPaket::find();

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
            'PAKET_ID' => $this->PAKET_ID,
            'PAKET_DURATION' => $this->PAKET_DURATION,
            'PAKET_DURATION_BONUS' => $this->PAKET_DURATION_BONUS,
            'HARGA_BULAN' => $this->HARGA_BULAN,
            'HARGA_HARI' => $this->HARGA_HARI,
            'HARGA_PAKET' => $this->HARGA_PAKET,
            'HARGA_PAKET_HARI' => $this->HARGA_PAKET_HARI,
            'PAKET_STT' => $this->PAKET_STT,
            'CREATE_AT' => $this->CREATE_AT,
            'UPDATE_AT' => $this->UPDATE_AT,
        ]);

        $query->andFilterWhere(['like', 'PAKET_GROUP', $this->PAKET_GROUP])
            ->andFilterWhere(['like', 'PAKET_NM', $this->PAKET_NM])
            ->andFilterWhere(['like', 'PAKET_STT_NM', $this->PAKET_STT_NM])
            ->andFilterWhere(['like', 'CREATE_BY', $this->CREATE_BY])
            ->andFilterWhere(['like', 'UPDATE_BY', $this->UPDATE_BY]);

        return $dataProvider;
    }
}
