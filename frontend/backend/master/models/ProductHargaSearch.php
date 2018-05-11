<?php

namespace frontend\backend\master\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\backend\master\models\ProductHarga;
use yii\data\ArrayDataProvider;

/**
 * ProductHargaSearch represents the model behind the search form of `frontend\backend\master\models\ProductHarga`.
 */
class ProductHargaSearch extends ProductHarga
{
    /**
     * @inheritdoc
     */
    public $PRODUCT_NM;
    public $thn;
    public function rules()
    {
        return [
            [['ID', 'STATUS', 'YEAR_AT', 'MONTH_AT','PERIODE_TGL1', 'PERIODE_TGL2','HPP', 'HARGA_JUAL','PPN'], 'integer'],
            [['ACCESS_GROUP', 'PRODUCT_NM','STORE_ID', 'PRODUCT_ID', 'PERIODE_TGL1', 'PERIODE_TGL2', 'START_TIME', 'CREATE_BY', 'CREATE_AT', 'UPDATE_BY', 'UPDATE_AT', 'DCRP_DETIL'], 'safe'],
            [['HPP', 'HARGA_JUAL','PPN'], 'number'],
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
        $query = ProductHarga::find();
        $query->joinWith(['product']);

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
            'PERIODE_TGL1' => $this->PERIODE_TGL1,
            'PERIODE_TGL2' => $this->PERIODE_TGL2,
            'START_TIME' => $this->START_TIME,
            'HPP' => $this->HPP,
            'HARGA_JUAL' => $this->HARGA_JUAL,
            'PPN' => $this->PPN,
            'CREATE_AT' => $this->CREATE_AT,
            'UPDATE_AT' => $this->UPDATE_AT,
            'product_harga.STATUS' => $this->STATUS,
            'product_harga.YEAR_AT' => $this->YEAR_AT,
            'product_harga.MONTH_AT' => $this->MONTH_AT,
        ]);

        $query->andFilterWhere(['like', 'product_harga.ACCESS_GROUP', $this->ACCESS_GROUP])
            ->andFilterWhere(['like', 'product_harga.STORE_ID', $this->STORE_ID])
            ->andFilterWhere(['like', 'product_harga.PRODUCT_ID', $this->PRODUCT_ID])
            ->andFilterWhere(['like', 'CREATE_BY', $this->CREATE_BY])
            ->andFilterWhere(['like', 'UPDATE_BY', $this->UPDATE_BY])
            ->andFilterWhere(['like', 'DCRP_DETIL', $this->DCRP_DETIL])
            ->andFilterWhere(['between','product_harga.CREATE_AT',date('Y-m-d', strtotime('-10 month', strtotime(date('Y-m-d')))),date('Y-m-d', strtotime('+1 year', strtotime(date('Y-m-d'))))])
            ->andFilterWhere(['like', 'product_harga.PRODUCT_NM', $this->PRODUCT_NM]);
            $query->orderBy(['CREATE_AT'=>SORT_DESC]);
        return $dataProvider;
    }
    
    public function searchExcelExport($params){
		
    $accessGroup=Yii::$app->getUserOpt->user()['ACCESS_GROUP'];//'170726220936';
      $TGL=$this->thn!=''?$this->thn:date('Y-m-d');
      $qrySql= Yii::$app->production_api->createCommand("
      select 
      inv.STORE_NM,
		inv.PRODUCT_ID,
		inv.PRODUCT_NM,
		inv.PERIODE_TGL2,
		inv.HPP,
        inv.HARGA_JUAL,
        MAX(CASE WHEN DATE_FORMAT(inv.PERIODE_TGL2,'%Y-%m-%d') >= '".$TGL."' THEN inv.HARGA_JUAL ELSE '' END) AS 'HARGAs_".$TGL."',
        MAX(CASE WHEN DATE_FORMAT(inv.PERIODE_TGL2,'%Y-%m-%d') >= '".$TGL."' THEN inv.HPP ELSE '' END) AS 'HPPs_".$TGL."'
      from
      (
        SELECT
            a2.PRODUCT_ID,																								
            a2.PRODUCT_NM,																							
            a3.STORE_NM,
            a1.PERIODE_TGL2,
            a1.HPP,
            a1.HARGA_JUAL
        FROM product as a2
        left join (SELECT ID,PRODUCT_ID,PERIODE_TGL2,HPP,HARGA_JUAL
        FROM product_harga
        WHERE ID IN (
            SELECT MAX(ID)
                FROM product_harga
            GROUP BY PRODUCT_ID
                )) a1 on a2.PRODUCT_ID=a1.PRODUCT_ID 
        left join store a3 on a3.STORE_ID=a2.STORE_ID
        WHERE a2.ACCESS_GROUP='".$accessGroup."'			
      ) inv
      GROUP BY inv.PRODUCT_ID")->queryAll(); 	

      // print_r($qrySql);die();
      $dataProvider= new ArrayDataProvider([	
          'allModels'=>$qrySql,	
          'pagination' => [
              'pageSize' =>10000,
          ],			
      ]);
      
      if (!($this->load($params) && $this->validate())) {
           return $dataProvider;
       }
      
      $filter = new Filter();
       $this->addCondition($filter, 'ACCESS_GROUP', true);	
      $this->addCondition($filter, 'STORE_ID', true);	
      $this->addCondition($filter, 'STORE_NM', true);	
      $this->addCondition($filter, 'PERIODE_TGL2', true);
       $this->addCondition($filter, 'HPP', true);	
       $this->addCondition($filter, 'PRODUCT_ID', true);	
       $this->addCondition($filter, 'PRODUCT_NM', true);	 		
       $this->addCondition($filter, 'HARGA_JUAL', true);	 		
       $dataProvider->allModels = $filter->filter($qrySql);
      return $dataProvider;
  } 
  
}
