<?php

namespace frontend\backend\laporan\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\backend\laporan\models\TransPenjualanHeader;

/**
 * TransPenjualanHeaderSearch represents the model behind the search form about `frontend\backend\laporan\models\TransPenjualanHeader`.
 */
class TransPenjualanHeaderSearch extends TransPenjualanHeader
{
	public function attributes()
	{
		/*Author -ptr.nov- add related fields to searchable attributes */
		return array_merge(parent::attributes(), [
			'storeNm','tgl','waktu','username'
		]);
	}
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'TYPE_PAY_ID', 'BANK_ID', 'STATUS', 'YEAR_AT', 'MONTH_AT'], 'integer'],
            [['ACCESS_GROUP', 'STORE_ID', 'ACCESS_ID', 'TRANS_ID', 'OFLINE_ID', 'TRANS_DATE', 'OPENCLOSE_ID', 'MERCHANT_ID', 'TYPE_PAY_NM', 'BANK_NM', 'MERCHANT_NM', 'MERCHANT_NO', 'CONSUMER_ID', 'CONSUMER_NM', 'CONSUMER_EMAIL', 'CONSUMER_PHONE', 'CREATE_AT', 'UPDATE_BY', 'UPDATE_AT', 'DCRP_DETIL'], 'safe'],
            [['TOTAL_PRODUCT', 'SUB_TOTAL_HARGA', 'PPN', 'TOTAL_HARGA'], 'number'],
            [['storeNm','tgl','waktu','username'], 'safe'],
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
        $query = TransPenjualanHeader::find()->where(['ACCESS_GROUP'=>Yii::$app->getUserOpt->user()['ACCESS_GROUP']]);
		$cnt=$query->count('TRANS_ID');
		// print_r($cnt);
		// die();
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'pagination' => [
				 'pageSize' => $cnt,
			]
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
            //'TRANS_DATE' => $this->TRANS_DATE,
            'TOTAL_PRODUCT' => $this->TOTAL_PRODUCT,
            'SUB_TOTAL_HARGA' => $this->SUB_TOTAL_HARGA,
            'PPN' => $this->PPN,
            'TOTAL_HARGA' => $this->TOTAL_HARGA,
            //'TYPE_PAY_ID' => $this->TYPE_PAY_NM,
            'BANK_ID' => $this->BANK_ID,
            'CREATE_AT' => $this->CREATE_AT,
            'UPDATE_AT' => $this->UPDATE_AT,
            'STATUS' => $this->STATUS,
            'YEAR_AT' => $this->YEAR_AT,
            'MONTH_AT' => $this->MONTH_AT,
        ]);

        $query->andFilterWhere(['like', 'ACCESS_GROUP', $this->ACCESS_GROUP])
            ->andFilterWhere(['like', 'STORE_ID', $this->storeNm])
            ->andFilterWhere(['like', 'ACCESS_ID', $this->ACCESS_ID])
            ->andFilterWhere(['like', 'TRANS_ID', $this->TRANS_ID])
            ->andFilterWhere(['like', 'OFLINE_ID', $this->OFLINE_ID])
            ->andFilterWhere(['like', 'OPENCLOSE_ID', $this->OPENCLOSE_ID])
            ->andFilterWhere(['like', 'MERCHANT_ID', $this->MERCHANT_ID])
            //->andFilterWhere(['like', 'TYPE_PAY_NM', $this->TYPE_PAY_NM])
            ->andFilterWhere(['like', 'BANK_NM', $this->BANK_NM])
            ->andFilterWhere(['like', 'MERCHANT_NM', $this->MERCHANT_NM])
            ->andFilterWhere(['like', 'MERCHANT_NO', $this->MERCHANT_NO])
            ->andFilterWhere(['like', 'CONSUMER_ID', $this->CONSUMER_ID])
            ->andFilterWhere(['like', 'CONSUMER_NM', $this->CONSUMER_NM])
            ->andFilterWhere(['like', 'CONSUMER_EMAIL', $this->CONSUMER_EMAIL])
            ->andFilterWhere(['like', 'CONSUMER_PHONE', $this->CONSUMER_PHONE])
            ->andFilterWhere(['like', 'TYPE_PAY_ID', $this->TYPE_PAY_NM])
            ->andFilterWhere(['like', 'TRANS_DATE',$this->tgl]);
           
        return $dataProvider;
    }
}
