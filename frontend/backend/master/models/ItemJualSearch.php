<?php

namespace frontend\backend\master\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\backend\master\models\ItemJual;

/**
 * ItemJualSearch represents the model behind the search form of `app\backend\master\models\ItemJual`.
 */
class ItemJualSearch extends ItemJual
{
	public function attributes()
	{
		//Author -ptr.nov- add related fields to searchable attributes 
		return array_merge(parent::attributes(), ['itemNm']);
	}
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'STATUS'], 'integer'],
            [['ACCESS_UNIX','CREATE_BY', 'CREATE_AT', 'UPDATE_BY', 
				'UPDATE_AT', 'ITEM_ID', 'OUTLET_CODE', 'PERIODE_TGL1',
				'PERIODE_TGL2', 'START_TIME', 'DCRIPT','itemNm'],
			'safe'],
            [['HARGA_JUAL'], 'number'],
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
        //$query = ItemJual::find();
		$query = ItemJual::find()->JoinWith('itemTbl',true,'LEFT JOIN');
        
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

		// $dataProvider->sort->attributes['item_jual.ITEM_ID'] = [
			// 'asc' => ['item_jual.ITEM_ID' => SORT_ASC],
			// 'desc' => ['item.ITEM_ID' => SORT_DESC],
		// ];
		
        // grid filtering conditions
        $query->andFilterWhere([
            'ID' => $this->ID,
            //'item.ACCESS_UNIX' => $this->ACCESS_UNIX,
            'CREATE_AT' => $this->CREATE_AT,
            'UPDATE_AT' => $this->UPDATE_AT,
            'STATUS' => $this->STATUS,
            'PERIODE_TGL1' => $this->PERIODE_TGL1,
            'PERIODE_TGL2' => $this->PERIODE_TGL2,
            'START_TIME' => $this->START_TIME,
            'HARGA_JUAL' => $this->HARGA_JUAL,
        ]);

        $query->andFilterWhere(['like', 'CREATE_BY', $this->CREATE_BY])
            ->andFilterWhere(['like', 'UPDATE_BY', $this->UPDATE_BY])
            ->andFilterWhere(['like', 'item.ITEM_ID', $this->ITEM_ID])
             ->andFilterWhere(['like', 'item.OUTLET_CODE', $this->OUTLET_CODE])
            ->andFilterWhere(['like', 'ITEM_NM', $this->itemNm])
            ->andFilterWhere(['like', 'DCRIPT', $this->DCRIPT]); 
		//$query->Where('FIND_IN_SET("'.$this->ACCESS_UNIX.'", item.ACCESS_UNIX)');
        return $dataProvider;
    }
}
