<?php

namespace frontend\backend\sistem\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\backend\sistem\models\DompetRekening;

/**
 * DompetRekeningSearch represents the model behind the search form of `frontend\backend\sistem\models\DompetRekening`.
 */
class DompetRekeningSearch extends DompetRekening
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'ACCESS_GROUP', 'ID_BANK', 'NO_REK', 'STATUS', 'YEAR_AT', 'MONTH_AT'], 'integer'],
            [['NAMA_LENGKAP', 'BANK', 'ALAMAT', 'TLP', 'CREATE_BY', 'CREATE_AT', 'UPDATE_BY', 'UPDATE_AT', 'DCRP_DETIL'], 'safe'],
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
        $query = DompetRekening::find();

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
            'ACCESS_GROUP' => $this->ACCESS_GROUP,
            'ID_BANK' => $this->ID_BANK,
            'NO_REK' => $this->NO_REK,
            'STATUS' => $this->STATUS,
            'CREATE_AT' => $this->CREATE_AT,
            'UPDATE_AT' => $this->UPDATE_AT,
            'YEAR_AT' => $this->YEAR_AT,
            'MONTH_AT' => $this->MONTH_AT,
        ]);

        $query->andFilterWhere(['like', 'NAMA_LENGKAP', $this->NAMA_LENGKAP])
            ->andFilterWhere(['like', 'BANK', $this->BANK])
            ->andFilterWhere(['like', 'ALAMAT', $this->ALAMAT])
            ->andFilterWhere(['like', 'TLP', $this->TLP])
            ->andFilterWhere(['like', 'CREATE_BY', $this->CREATE_BY])
            ->andFilterWhere(['like', 'UPDATE_BY', $this->UPDATE_BY])
            ->andFilterWhere(['like', 'DCRP_DETIL', $this->DCRP_DETIL]);

        return $dataProvider;
    }
}
