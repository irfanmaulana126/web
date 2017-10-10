<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Store;
use common\models\user;

/**
 * StoreSearch represents the model behind the search form about `lukisongroup\efenbi\rasasayang\models\Store`.
 */
class StoreSearch extends Store
{
		
	/* public function attributes()
	{
		//Author -ptr.nov- add related fields to searchable attributes 
		//return array_merge(parent::attributes(), ['ProvinsiNm','KotaNm','countProvinsi','expired']);
	} */
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CREATE_AT', 'UPDATE_AT','ACCESS_ID'], 'safe'],
            [['STATUS'], 'integer'],
            [['ALAMAT'], 'string'],
            [['CREATE_BY', 'UPDATE_BY', 'STORE_ID', 'TLP'], 'string', 'max' => 50],
            [['STORE_NM', 'PIC','FAX'], 'string', 'max' => 100],  
			
			[['ACCESS_ID', 'UUID', 'PLAYER_ID', 'ALAMAT', 'DCRP_DETIL'], 'string'],
			//[['INDUSTRY_ID','INDUSTRY_NM','INDUSTRY_GRP_ID'.'INDUSTRY_GRP_NM'], 'string'],
			[['DATE_START', 'DATE_END', 'CREATE_AT', 'UPDATE_AT','PPN'], 'safe'],
			[['PROVINCE_ID', 'CITY_ID', 'STATUS', 'YEAR_AT', 'MONTH_AT'], 'integer'],
			[['ACCESS_GROUP'], 'string', 'max' => 15],
			[['STORE_ID'], 'string', 'max' => 25],
			[['STORE_NM', 'PIC'], 'string', 'max' => 100],
			[['PROVINCE_NM', 'CITY_NAME', 'TLP', 'FAX', 'CREATE_BY', 'UPDATE_BY'], 'string', 'max' => 50], 
        ];
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
        $query = Store::find();//->JoinWith('provinsiTbl',true,'LEFT JOIN')->JoinWith('kotaTbl',true,'LEFT JOIN');
        //$query = Store::find();

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
        // $query->andFilterWhere([
            // 'ID' => $this->ID,
            // 'STATUS' => $this->STATUS
        // ]);
		/* SORTING Group Function Author -ptr.nov-*/
		// $dataProvider->sort->attributes['ProvinsiNm'] = [
			// 'asc' => ['locate_province.ProvinsiNm' => SORT_ASC],
			// 'desc' => ['locate_province.ProvinsiNm' => SORT_DESC],
		// ];
		// $dataProvider->sort->attributes['KotaNm'] = [
			// 'asc' => ['locate_city.KotaNm' => SORT_ASC],
			// 'desc' => ['locate_city.KotaNm' => SORT_DESC],
		// ];
		
       $query->andFilterWhere(['like', 'CREATE_BY', $this->CREATE_BY])           
            ->andFilterWhere(['like', 'CREATE_AT', $this->CREATE_AT])
			 ->andFilterWhere(['like', 'UPDATE_BY', $this->UPDATE_BY])
            ->andFilterWhere(['like', 'UPDATE_AT', $this->UPDATE_AT])
            ->andFilterWhere(['like', 'STORE_ID', $this->STORE_ID])
            ->andFilterWhere(['like', 'STORE_NM', $this->STORE_NM])
            ->andFilterWhere(['like', 'ALAMAT', $this->ALAMAT])
            // ->andFilterWhere(['like', 'LOCATE_PROVINCE', $this->ProvinsiNm])
            // ->andFilterWhere(['like', 'LOCATE_CITY', $this->KotaNm])
            ->andFilterWhere(['like', 'PIC', $this->PIC])
            ->andFilterWhere(['like', 'TLP', $this->TLP])
            ->andFilterWhere(['like', 'FAX', $this->FAX]);

        return $dataProvider;
    }
	
	public function searchUserStore($params)
    {
		$query = Store::find();//->JoinWith('provinsiTbl',true,'LEFT JOIN')->JoinWith('kotaTbl',true,'LEFT JOIN');
        //$query = Store::find();
	
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
		
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        } 
		
		$query->Where('FIND_IN_SET("'.Yii::$app->user->identity->ACCESS_ID.'", ACCESS_ID)');
		//$query->Where('FIND_IN_SET("170726220936", ACCESS_ID)');
		//$query->Where('FIND_IN_SET("'.$this->ACCESS_ID.'", ACCESS_ID)');
		//$query->asArray();
		$query->andFilterWhere([
            'ID' => $this->ID,
            'STATUS' => $this->STATUS
        ]);
        return $dataProvider;
	}
}
