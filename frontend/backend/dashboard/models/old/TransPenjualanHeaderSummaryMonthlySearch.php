<?php

namespace frontend\backend\dashboard\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use frontend\backend\dashboard\models\TransPenjualanHeaderSummaryMonthly;

/**
 * TransPenjualanHeaderSummaryMonthlySearch represents the model behind the search form about `frontend\backend\laporan\models\TransPenjualanHeaderSummaryMonthly`.
 */
class TransPenjualanHeaderSummaryMonthlySearch extends TransPenjualanHeaderSummaryMonthly
{
	public $thn;
    /**
     * @inheritdoc
     */
	 
	
	
    public function rules()
    {
        return [
            [['ID', 'BULAN', 'TOTAL_PRODUCT', 'JUMLAH_TRANSAKSI', 'CNT_TUNAI', 'CNT_DEBET', 'CNT_KREDIT', 'CNT_EMONEY', 'CNT_BCA', 'CNT_MANDIRI', 'CNT_BNI', 'CNT_BRI'], 'integer'],
            [['ACCESS_GROUP', 'STORE_ID', 'TAHUN', 'CREATE_AT', 'UPDATE_AT', 'KETERANGAN','thn','storeNm'], 'safe'],
            [['TOTAL_HPP', 'TOTAL_SALES', 'TTL_TUNAI', 'TTL_DEBET', 'TTL_KREDIT', 'TTL_EMONEY'], 'number'],
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
        $query = TransPenjualanHeaderSummaryMonthly::find();

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
            'BULAN' => $this->BULAN,
            'TOTAL_HPP' => $this->TOTAL_HPP,
            'TOTAL_SALES' => $this->TOTAL_SALES,
            'TOTAL_PRODUCT' => $this->TOTAL_PRODUCT,
            'JUMLAH_TRANSAKSI' => $this->JUMLAH_TRANSAKSI,
            'CNT_TUNAI' => $this->CNT_TUNAI,
            'CNT_DEBET' => $this->CNT_DEBET,
            'CNT_KREDIT' => $this->CNT_KREDIT,
            'CNT_EMONEY' => $this->CNT_EMONEY,
            'TTL_TUNAI' => $this->TTL_TUNAI,
            'TTL_DEBET' => $this->TTL_DEBET,
            'TTL_KREDIT' => $this->TTL_KREDIT,
            'TTL_EMONEY' => $this->TTL_EMONEY,
            'CNT_BCA' => $this->CNT_BCA,
            'CNT_MANDIRI' => $this->CNT_MANDIRI,
            'CNT_BNI' => $this->CNT_BNI,
            'CNT_BRI' => $this->CNT_BRI,
            'CREATE_AT' => $this->CREATE_AT,
            'UPDATE_AT' => $this->UPDATE_AT,
        ]);

        $query->andFilterWhere(['like', 'ACCESS_GROUP', $this->ACCESS_GROUP])
            ->andFilterWhere(['like', 'STORE_ID', $this->STORE_ID])
            ->andFilterWhere(['like', 'TAHUN', $this->TAHUN])
            ->andFilterWhere(['like', 'KETERANGAN', $this->KETERANGAN]);

        return $dataProvider;
    }
	
	/*==========================
	* ARUS KAS MASUK & KELUAR
	*===========================*/
	public function searchKasMasukYear($params)
    {
		$setTahun=$this->thn!=''?$this->thn:date('Y');
		$qryStr="SELECT x2.BULAN_ID,x2.BULAN_NM,
					(CASE WHEN x1.TOTAL_SALES IS NOT NULL THEN x1.TOTAL_SALES ELSE 0 END) AS TOTAL_SALES,
					(CASE WHEN x1.PENJUALAN_TUNAI IS NOT NULL THEN x1.PENJUALAN_TUNAI ELSE 0 END) AS PENJUALAN_TUNAI,
					(CASE WHEN x1.PENJUALAN_EDC IS NOT NULL THEN x1.PENJUALAN_EDC ELSE 0 END) AS PENJUALAN_EDC,
					(CASE WHEN x3.TTL_1 IS NOT NULL THEN (x3.TTL_1 + x3.TTL_2 + x3.TTL_3 + x3.TTL_4 + x3.TTL_5 + x3.TTL_6 + x3.TTL_7 + x3.TTL_8 + x3.TTL_9) ELSE 0 END) AS TOTAL_KELUAR,
					(CASE WHEN x3.TTL_1 IS NOT NULL THEN x3.TTL_1 ELSE 0 END) AS LANGANAN,
					(CASE WHEN x3.TTL_2 IS NOT NULL THEN x3.TTL_2 ELSE 0 END) AS DEPOSIT,
					(CASE WHEN x3.TTL_3 IS NOT NULL THEN x3.TTL_3 ELSE 0 END) AS MODAL_KASIR,
					(CASE WHEN x3.TTL_4 IS NOT NULL THEN x3.TTL_4 ELSE 0 END) AS PAYROLL,
					(CASE WHEN x3.TTL_6 IS NOT NULL THEN (x3.TTL_6 + x3.TTL_7 + x3.TTL_8) ELSE 0 END) AS OPS,
					(CASE WHEN x3.TTL_9 IS NOT NULL THEN x3.TTL_9 ELSE 0 END) AS LAIN_LAIN 
				FROM 
				( SELECT BULAN,TOTAL_SALES,TAHUN,TTL_TUNAI AS PENJUALAN_TUNAI, (TTL_DEBET + TTL_KREDIT + TTL_EMONEY) AS PENJUALAN_EDC
					FROM trans_penjualan_header_summary_monthly 
					WHERE ACCESS_GROUP='".Yii::$app->getUserOpt->user()['ACCESS_GROUP']."' AND TAHUN='".$setTahun."'
					GROUP BY ACCESS_GROUP,BULAN
				) x1 RIGHT JOIN componen_bulan x2
				ON x1.BULAN=x2.BULAN_ID
				LEFT JOIN (select * FROM trans_pengeluaran_summary_monthly GROUP BY  ACCESS_GROUP,BULAN) x3 on x3.BULAN=x2.BULAN_ID
				ORDER BY x2.BULAN_ID ASC
		";
		$qrySql= Yii::$app->production_api->createCommand($qryStr)->queryAll(); 
		$provider = new ArrayDataProvider([
			'allModels' => $qrySql,
			'pagination' => [
				'pageSize' => 12,
			],
		]);		
		
		return $provider;
	}
	
	
}
