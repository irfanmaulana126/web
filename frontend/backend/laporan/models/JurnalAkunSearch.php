<?php

namespace frontend\backend\laporan\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\backend\laporan\models\JurnalAkun;

/**
 * JurnalAkunSearch represents the model behind the search form of `frontend\backend\laporan\models\JurnalAkun`.
 */
class JurnalAkunSearch extends JurnalAkun
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['AKUN_CODE', 'AKUN_NM', 'KTG_NM', 'KETERANGAN'], 'safe'],
            [['KTG_CODE', 'STATUS'], 'integer'],
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
        $query = JurnalAkun::find();

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
            'KTG_CODE' => $this->KTG_CODE,
            'STATUS' => $this->STATUS,
        ]);

        $query->andFilterWhere(['like', 'AKUN_CODE', $this->AKUN_CODE])
            ->andFilterWhere(['like', 'AKUN_NM', $this->AKUN_NM])
            ->andFilterWhere(['like', 'KTG_NM', $this->KTG_NM])
            ->andFilterWhere(['like', 'KETERANGAN', $this->KETERANGAN]);

        return $dataProvider;
    }
}
