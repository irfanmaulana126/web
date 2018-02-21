<?php

namespace frontend\backend\payment\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\backend\payment\models\DompetTranscode;

/**
 * DompetTranscodeSearch represents the model behind the search form of `frontend\backend\payment\models\DompetTranscode`.
 */
class DompetTranscodeSearch extends DompetTranscode
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TRANSCODE', 'TRANS_NM', 'TRANS_DCRP', 'TRANS_TYPE_NM', 'CREATE_BY', 'CREATE_AT', 'UPDATE_BY', 'UPDATE_AT'], 'safe'],
            [['TRANS_TYPE'], 'integer'],
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
        $query = DompetTranscode::find();

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
            'CREATE_AT' => $this->CREATE_AT,
            'UPDATE_AT' => $this->UPDATE_AT,
        ]);

        $query->andFilterWhere(['like', 'TRANSCODE', $this->TRANSCODE])
            ->andFilterWhere(['like', 'TRANS_NM', $this->TRANS_NM])
            ->andFilterWhere(['like', 'TRANS_DCRP', $this->TRANS_DCRP])
            ->andFilterWhere(['like', 'TRANS_TYPE_NM', $this->TRANS_TYPE_NM])
            ->andFilterWhere(['like', 'CREATE_BY', $this->CREATE_BY])
            ->andFilterWhere(['like', 'UPDATE_BY', $this->UPDATE_BY]);

        return $dataProvider;
    }
}
