<?php

namespace frontend\backend\laporan\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\backend\laporan\models\PtrKasirTh1cDonasi;

/**
 * PtrKasirTh1cDonasiSearch represents the model behind the search form of `frontend\backend\laporan\models\PtrKasirTh1cDonasi`.
 */
class PtrKasirTh1cDonasiSearch extends PtrKasirTh1cDonasi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TRANS_MONTH', 'ACCESS_GROUP', 'STORE_ID', 'STORE_NM', 'TRANS_DATE', 'CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['TAHUN', 'BULAN', 'STT', 'MONTH_AT', 'YEAR_AT'], 'integer'],
            [['JUMLAH_DONASI'], 'number'],
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
        $query = PtrKasirTh1cDonasi::find();

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
            'JUMLAH_DONASI' => $this->JUMLAH_DONASI,
            'STT' => $this->STT,
            'CREATE_AT' => $this->CREATE_AT,
            'UPDATE_AT' => $this->UPDATE_AT,
            'MONTH_AT' => $this->MONTH_AT,
            'YEAR_AT' => $this->YEAR_AT,
        ]);

        $query->andFilterWhere(['like', 'TRANS_MONTH', $this->TRANS_MONTH])
            ->andFilterWhere(['like', 'ACCESS_GROUP', $this->ACCESS_GROUP])
            ->andFilterWhere(['like', 'STORE_ID', $this->STORE_ID])
            ->andFilterWhere(['like', 'STORE_NM', $this->STORE_NM]);

        return $dataProvider;
    }
}
