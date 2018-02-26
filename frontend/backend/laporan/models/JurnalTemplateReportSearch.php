<?php

namespace frontend\backend\laporan\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\backend\laporan\models\JurnalTemplateReport;

/**
 * JurnalTemplateReportSearch represents the model behind the search form of `frontend\backend\laporan\models\JurnalTemplateReport`.
 */
class JurnalTemplateReportSearch extends JurnalTemplateReport
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['RPT_GROUP__ID', 'STATUS'], 'integer'],
            [['RPT_GROUP_NM', 'KETERANGAN'], 'safe'],
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
        $query = JurnalTemplateReport::find();

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
            'RPT_GROUP__ID' => $this->RPT_GROUP__ID,
            'STATUS' => $this->STATUS,
        ]);

        $query->andFilterWhere(['like', 'RPT_GROUP_NM', $this->RPT_GROUP_NM])
            ->andFilterWhere(['like', 'KETERANGAN', $this->KETERANGAN]);

        return $dataProvider;
    }
}
