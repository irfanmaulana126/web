<?php

namespace frontend\backend\laporan\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\backend\laporan\models\TransOpenclose;

/**
 * TransOpencloseSearch represents the model behind the search form about `frontend\backend\laporan\models\TransOpenclose`.
 */
class TransOpencloseSearch extends TransOpenclose
{
	
	public function attributes()
	{
		/*Author -ptr.nov- add related fields to searchable attributes */
		return array_merge(parent::attributes(), ['storeNm']);
	}
	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'STATUS', 'YEAR_AT', 'MONTH_AT'], 'integer'],
            [['storeNm','ACCESS_GROUP', 'STORE_ID', 'ACCESS_ID', 'OPENCLOSE_ID', 'TGL_OPEN', 'TGL_CLOSE', 'CREATE_BY', 'CREATE_AT', 'UPDATE_BY', 'UPDATE_AT', 'DCRP_DETIL'], 'safe'],
            [['CASHINDRAWER', 'ADDCASH', 'SELLCASH', 'TOTALCASH', 'TOTALCASH_ACTUAL'], 'number'],
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
        $query = TransOpenclose::find();

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
            //'TGL_OPEN' => $this->TGL_OPEN,
            'TGL_CLOSE' => $this->TGL_CLOSE,
            'CASHINDRAWER' => $this->CASHINDRAWER,
            'ADDCASH' => $this->ADDCASH,
            'SELLCASH' => $this->SELLCASH,
            'TOTALCASH' => $this->TOTALCASH,
            'TOTALCASH_ACTUAL' => $this->TOTALCASH_ACTUAL,
            'CREATE_AT' => $this->CREATE_AT,
            'UPDATE_AT' => $this->UPDATE_AT,
            'STATUS' => $this->STATUS,
            'YEAR_AT' => $this->YEAR_AT,
            'MONTH_AT' => $this->MONTH_AT,
        ]);

        $query->andFilterWhere(['like', 'ACCESS_GROUP', $this->ACCESS_GROUP])
			// ->andFilterWhere(['between', 'IN_TGL', $modelPrd->TGL_START, $modelPrd->TGL_END])
            ->andFilterWhere(['like', 'TGL_OPEN', $this->TGL_OPEN])
            ->andFilterWhere(['like', 'STORE_ID', $this->STORE_ID])
            ->andFilterWhere(['like', 'ACCESS_ID', $this->ACCESS_ID])
            ->andFilterWhere(['like', 'OPENCLOSE_ID', $this->OPENCLOSE_ID])
            ->andFilterWhere(['like', 'CREATE_BY', $this->CREATE_BY])
            ->andFilterWhere(['like', 'UPDATE_BY', $this->UPDATE_BY])
            ->andFilterWhere(['like', 'DCRP_DETIL', $this->DCRP_DETIL]);

        return $dataProvider;
    }
}
