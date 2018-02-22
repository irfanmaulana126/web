<?php

namespace frontend\backend\inventory\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
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
    public function searchDownload($params){
		
        $accessGroup=Yii::$app->getUserOpt->user()['ACCESS_GROUP'];//'170726220936';
        $this->TAHUN;
        $this->BULAN;
        // print_r($this->BULAN);die();
        $qrySql= Yii::$app->production_api->createCommand('SELECT UNIX_BULAN_ID,STORE_NM,PRODUCT_NM,STOCK_INPUT_ACTUAL FROM product_stock_closing as a inner join store as b on a.STORE_ID=b.STORE_ID Inner Join product as c on a.PRODUCT_ID=c.PRODUCT_ID 
                WHERE b.ACCESS_GROUP="'.$accessGroup.'" AND a.TAHUN = "'.$this->TAHUN.'" AND a.BULAN="'.$this->BULAN.'" ORDER BY b.STORE_ID')->queryAll(); 	
      $dataProvider= new ArrayDataProvider([	
          'allModels'=>$qrySql,	
          'pagination' => [
              'pageSize' =>10000,
          ],			
      ]);
      
      if (!($this->load($params) && $this->validate())) {
           return $dataProvider;
      }
  } 
    public function searchExport($params){
		
        $accessGroup=Yii::$app->getUserOpt->user()['ACCESS_GROUP'];//'170726220936';
        $this->TAHUN;
        $this->BULAN;
        // print_r($this->BULAN);die();
        $qrySql= Yii::$app->production_api->createCommand('SELECT STORE_NM,PRODUCT_NM,TAHUN,BULAN,STOCK_AWAL,STOCK_BARU,STOCK_TERJUAL, STOCK_REFUND, STOCK_AKHIR, STOCK_BALANCE_CLOSING, STOK_CLOSING, STOCK_INPUT_ACTUAL, STOCK_BALANCE_BULAN, STOCK_AKHIR_ACTUAL FROM product_stock_closing as a inner join store as b on a.STORE_ID=b.STORE_ID Inner Join product as c on a.PRODUCT_ID=c.PRODUCT_ID 
                WHERE b.ACCESS_GROUP="'.$accessGroup.'" AND a.TAHUN = "'.$this->TAHUN.'" AND a.BULAN="'.$this->BULAN.'" ORDER BY b.STORE_ID')->queryAll(); 	
      $dataProvider= new ArrayDataProvider([	
          'allModels'=>$qrySql,	
          'pagination' => [
              'pageSize' =>10000,
          ],			
      ]);
      
      if (!($this->load($params) && $this->validate())) {
           return $dataProvider;
      }
  } 
}
