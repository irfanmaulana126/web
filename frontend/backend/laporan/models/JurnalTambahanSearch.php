<?php

namespace frontend\backend\laporan\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\backend\laporan\models\JurnalTambahan;

/**
 * JurnalTambahanSearch represents the model behind the search form of `frontend\backend\laporan\models\JurnalTambahan`.
 */
class JurnalTambahanSearch extends JurnalTambahan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['JURNAL_ID', 'ACCESS_GROUP', 'STORE_ID', 'TRANS_DATE', 'STT_PAY_NM', 'AKUN_CODE', 'AKUN_NM', 'KTG_NM', 'FREKUENSI_NM', 'RANGE_TGL1', 'RANGE_TGL2', 'CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['STT_PAY', 'KTG_CODE', 'FREKUENSI', 'MONTH_AT', 'YEAR_AT'], 'integer'],
            [['JUMLAH_TOTAL', 'JUMLAH_PEMBAGIAN'], 'number'],
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
        $query = JurnalTambahan::find();

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
            'STT_PAY' => $this->STT_PAY,
            'KTG_CODE' => $this->KTG_CODE,
            'JUMLAH_TOTAL' => $this->JUMLAH_TOTAL,
            'JUMLAH_PEMBAGIAN' => $this->JUMLAH_PEMBAGIAN,
            'FREKUENSI' => $this->FREKUENSI,
            'RANGE_TGL1' => $this->RANGE_TGL1,
            'RANGE_TGL2' => $this->RANGE_TGL2,
            'CREATE_AT' => $this->CREATE_AT,
            'UPDATE_AT' => $this->UPDATE_AT,
            'MONTH_AT' => $this->MONTH_AT,
            'YEAR_AT' => $this->YEAR_AT,
        ]);

        $query->andFilterWhere(['like', 'JURNAL_ID', $this->JURNAL_ID])
            ->andFilterWhere(['like', 'ACCESS_GROUP', $this->ACCESS_GROUP])
            ->andFilterWhere(['like', 'STORE_ID', $this->STORE_ID])
            ->andFilterWhere(['like', 'STT_PAY_NM', $this->STT_PAY_NM])
            ->andFilterWhere(['like', 'AKUN_CODE', $this->AKUN_CODE])
            ->andFilterWhere(['like', 'AKUN_NM', $this->AKUN_NM])
            ->andFilterWhere(['like', 'KTG_NM', $this->KTG_NM])
            ->andFilterWhere(['like', 'FREKUENSI_NM', $this->FREKUENSI_NM]);

        return $dataProvider;
    }
}
