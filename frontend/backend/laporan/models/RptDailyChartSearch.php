<?php

namespace frontend\backend\laporan\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\backend\laporan\models\RptDailyChart;

/**
 * RptDailyChartSearch represents the model behind the search form about `frontend\backend\laporan\models\RptDailyChart`.
 */
class RptDailyChartSearch extends RptDailyChart
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id'], 'integer'],
			[['Val_Cnt','Val_Nm'], 'safe'],
            [['Val_Json', 'ACCESS_GROUP', 'UPDT'], 'safe'],
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
        $query = RptDailyChart::find()->where(['ACCESS_GROUP'=>Yii::$app->getUserOpt->user()['ACCESS_GROUP']]);

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
            'Id' => $this->Id,
            'Val_Cnt' => $this->Val_Cnt,
            'UPDT' => $this->UPDT,
        ]);

        $query->andFilterWhere(['like', 'Val_Nm', $this->Val_Nm])
            ->andFilterWhere(['like', 'Val_Json', $this->Val_Json])
            ->andFilterWhere(['like', 'ACCESS_GROUP', $this->ACCESS_GROUP]);

        return $dataProvider;
    }
}
