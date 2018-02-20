<?php

namespace frontend\backend\laporan\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\backend\laporan\models\JurnalTransaksiBulan;

/**
 * JurnalTransaksiBulanSearch represents the model behind the search form of `frontend\backend\laporan\models\JurnalTransaksiBulan`.
 */
class JurnalTransaksiBulanSearch extends JurnalTransaksiBulan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['JURNAL_BULAN', 'ACCESS_GROUP', 'STORE_ID', 'TRANS_DATE', 'STT_NM', 'AKUN_CODE', 'AKUN_NM', 'KTG_NM', 'CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['TAHUN', 'BULAN', 'STT_PAY', 'KTG_CODE'], 'integer'],
            [['JUMLAH'], 'number'],
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
        $query = JurnalTransaksiBulan::find();

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
            'TRANS_DATE' => $this->TRANS_DATE,
            'TAHUN' => $this->TAHUN,
            'BULAN' => $this->BULAN,
            'JUMLAH' => $this->JUMLAH,
            'STT_PAY' => $this->STT_PAY,
            'KTG_CODE' => $this->KTG_CODE,
            'CREATE_AT' => $this->CREATE_AT,
            'UPDATE_AT' => $this->UPDATE_AT,
        ]);

        $query->andFilterWhere(['like', 'JURNAL_BULAN', $this->JURNAL_BULAN])
            ->andFilterWhere(['like', 'ACCESS_GROUP', $this->ACCESS_GROUP])
            ->andFilterWhere(['like', 'STORE_ID', $this->STORE_ID])
            ->andFilterWhere(['like', 'STT_NM', $this->STT_NM])
            ->andFilterWhere(['like', 'AKUN_CODE', $this->AKUN_CODE])
            ->andFilterWhere(['like', 'AKUN_NM', $this->AKUN_NM])
            ->andFilterWhere(['like', 'KTG_NM', $this->KTG_NM]);

        return $dataProvider;
    }
}
