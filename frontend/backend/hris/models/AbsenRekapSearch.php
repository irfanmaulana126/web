<?php

namespace frontend\backend\hris\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\backend\hris\models\AbsenRekap;

/**
 * HrdAbsenRekapSearch represents the model behind the search form about `frontend\backend\hris\models\HrdAbsenRekap`.
 */
class AbsenRekapSearch extends AbsenRekap
{
	public function attributes()
	{
		return array_merge(parent::attributes(), ['storeNm']);
	}
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'SHIFT_ID', 'IZIN_STT', 'IZIN', 'ACTIVE_TELAT', 'ACTIVE_PULANG', 'ACTIVE_IZIN', 'IN_SEQ', 'SEQ_SHIFT', 'STATUS', 'YEAR_AT', 'MONTH_AT'], 'integer'],
            [['ACCESS_GROUP', 'STORE_ID', 'KARYAWAN_ID', 'KARYAWAN', 'TGL', 'WAKTU_MASUK', 'WAKTU_KELUAR', 'SHIFT_NM', 'SHIFT_IN', 'SHIFT_OUT', 'SHIFT_TELAT', 'SHIFT_PULANG', 'SELISIH_TELAT', 'SELISIH_AWALPULANG', 'KELEBIHAN_WAKTU', 'IZIN_STT_NM', 'IZIN_NM', 'POT_JAM_TELAT', 'POT_JAM_PULANG', 'LEMBUR_JAM', 'ID_TELAT', 'ID_AWALPULANG', 'IN_ABSENID', 'OUT_ABSENID', 'ID_LEMBUR', 'CREATE_BY', 'CREATE_AT', 'UPDATE_BY', 'UPDATE_AT', 'DCRP_DETIL'], 'safe'],
            [['SHIFT_RADIUS', 'MASUK_LAT', 'MASUK_LAG', 'MASUK_RADIUS', 'PULANG_LAT', 'PULANG_LAG', 'PULANG_RADIUS', 'POT_PERSEN_TELAT', 'POT_RUPIAH_TELAT', 'POT_PERSEN_PULANG', 'POT_RUPIAH_PULANG', 'LEMBUR_PERSEN', 'LEMBUR_RUPIAH', 'UPAH_HARIAN'], 'number'],
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
        $query = AbsenRekap::find();

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
            'TGL' => $this->TGL,
            'WAKTU_MASUK' => $this->WAKTU_MASUK,
            'WAKTU_KELUAR' => $this->WAKTU_KELUAR,
            'SHIFT_ID' => $this->SHIFT_ID,
            'SHIFT_IN' => $this->SHIFT_IN,
            'SHIFT_OUT' => $this->SHIFT_OUT,
            'SHIFT_TELAT' => $this->SHIFT_TELAT,
            'SHIFT_PULANG' => $this->SHIFT_PULANG,
            'SHIFT_RADIUS' => $this->SHIFT_RADIUS,
            'SELISIH_TELAT' => $this->SELISIH_TELAT,
            'SELISIH_AWALPULANG' => $this->SELISIH_AWALPULANG,
            'KELEBIHAN_WAKTU' => $this->KELEBIHAN_WAKTU,
            'IZIN_STT' => $this->IZIN_STT,
            'IZIN' => $this->IZIN,
            'MASUK_LAT' => $this->MASUK_LAT,
            'MASUK_LAG' => $this->MASUK_LAG,
            'MASUK_RADIUS' => $this->MASUK_RADIUS,
            'PULANG_LAT' => $this->PULANG_LAT,
            'PULANG_LAG' => $this->PULANG_LAG,
            'PULANG_RADIUS' => $this->PULANG_RADIUS,
            'ACTIVE_TELAT' => $this->ACTIVE_TELAT,
            'ACTIVE_PULANG' => $this->ACTIVE_PULANG,
            'ACTIVE_IZIN' => $this->ACTIVE_IZIN,
            'POT_PERSEN_TELAT' => $this->POT_PERSEN_TELAT,
            'POT_RUPIAH_TELAT' => $this->POT_RUPIAH_TELAT,
            'POT_JAM_TELAT' => $this->POT_JAM_TELAT,
            'POT_PERSEN_PULANG' => $this->POT_PERSEN_PULANG,
            'POT_RUPIAH_PULANG' => $this->POT_RUPIAH_PULANG,
            'POT_JAM_PULANG' => $this->POT_JAM_PULANG,
            'LEMBUR_PERSEN' => $this->LEMBUR_PERSEN,
            'LEMBUR_RUPIAH' => $this->LEMBUR_RUPIAH,
            'LEMBUR_JAM' => $this->LEMBUR_JAM,
            'UPAH_HARIAN' => $this->UPAH_HARIAN,
            'IN_SEQ' => $this->IN_SEQ,
            'SEQ_SHIFT' => $this->SEQ_SHIFT,
            'CREATE_AT' => $this->CREATE_AT,
            'UPDATE_AT' => $this->UPDATE_AT,
            'STATUS' => $this->STATUS,
            'YEAR_AT' => $this->YEAR_AT,
            'MONTH_AT' => $this->MONTH_AT,
        ]);

        $query->andFilterWhere(['like', 'ACCESS_GROUP', $this->ACCESS_GROUP])
            ->andFilterWhere(['like', 'STORE_ID', $this->STORE_ID])
            ->andFilterWhere(['like', 'KARYAWAN_ID', $this->KARYAWAN_ID])
            ->andFilterWhere(['like', 'KARYAWAN', $this->KARYAWAN])
            ->andFilterWhere(['like', 'SHIFT_NM', $this->SHIFT_NM])
            ->andFilterWhere(['like', 'IZIN_STT_NM', $this->IZIN_STT_NM])
            ->andFilterWhere(['like', 'IZIN_NM', $this->IZIN_NM])
            ->andFilterWhere(['like', 'ID_TELAT', $this->ID_TELAT])
            ->andFilterWhere(['like', 'ID_AWALPULANG', $this->ID_AWALPULANG])
            ->andFilterWhere(['like', 'IN_ABSENID', $this->IN_ABSENID])
            ->andFilterWhere(['like', 'OUT_ABSENID', $this->OUT_ABSENID])
            ->andFilterWhere(['like', 'ID_LEMBUR', $this->ID_LEMBUR])
            ->andFilterWhere(['like', 'CREATE_BY', $this->CREATE_BY])
            ->andFilterWhere(['like', 'UPDATE_BY', $this->UPDATE_BY])
            ->andFilterWhere(['like', 'DCRP_DETIL', $this->DCRP_DETIL]);

        return $dataProvider;
    }
}
