<?php

namespace frontend\backend\inventory\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\backend\inventory\models\ProductStockClosing;

/**
 * ProductStockClosingSearch represents the model behind the search form of `frontend\backend\inventory\models\ProductStockClosing`.
 */
class ProductStockClosingSearch extends ProductStockClosing
{
	public function attributes()
	{
		/*Author -ptr.nov- add related fields to searchable attributes */
		return array_merge(parent::attributes(), ['storeNm','produkNm']);
	}
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['UNIX_BULAN_ID', 'ACCESS_GROUP', 'STORE_ID', 'PRODUCT_ID', 'TAHUN', 'CREATE_BY', 'CREATE_AT', 'UPDATE_BY', 'UPDATE_AT', 'CREATE_UUID', 'UPDATE_UUID', 'DCRP_DETIL','storeNm','produkNm'], 'safe'],
            [['BULAN', 'STATUS', 'YEAR_AT', 'MONTH_AT'], 'integer'],
            [['STOK_CLOSING','STOCK_BALANCE_BULAN','STOCK_AWAL', 'STOCK_BARU', 'STOCK_TERJUAL', 'STOCK_REFUND', 'STOCK_AKHIR', 'STOCK_BALANCE_CLOSING', 'STOCK_INPUT_ACTUAL', 'STOCK_AKHIR_ACTUAL', 'STOCK_AWAL_ACTUAL'], 'number'],
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
		$accessGroup=Yii::$app->getUserOpt->user()['ACCESS_GROUP'];//'170726220936';
		//$TGL=$this->thn!=''?$this->thn:date('Y-m-d');
        $query = ProductStockClosing::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'pagination' => [
				'pageSize' => 1000,
			],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'TAHUN' => $this->TAHUN,
            'BULAN' => $this->BULAN,
			'ACCESS_GROUP'=>$accessGroup,
            'STATUS' => $this->STATUS
        ]);

        $query->andFilterWhere(['like', 'UNIX_BULAN_ID', $this->UNIX_BULAN_ID])
            ->andFilterWhere(['like', 'STORE_ID', $this->STORE_ID])
            ->andFilterWhere(['like', 'PRODUCT_ID', $this->PRODUCT_ID]);

        return $dataProvider;
    }
}
