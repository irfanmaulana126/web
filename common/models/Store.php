<?php

namespace common\models;

use Yii;
use api\modules\master\models\Item;
use yii\helpers\ArrayHelper;

class Store extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'store';
    }

    public static function getDb()
    {
        return Yii::$app->get('production_api');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			[['ACCESS_ID', 'UUID', 'PLAYER_ID', 'ALAMAT', 'DCRP_DETIL'], 'string'],
			[['INDUSTRY_ID','INDUSTRY_NM','INDUSTRY_GRP_ID'.'INDUSTRY_GRP_NM'], 'string'],
			[['DATE_START', 'DATE_END', 'CREATE_AT', 'UPDATE_AT','PPN'], 'safe'],
			[['PROVINCE_ID', 'CITY_ID', 'STATUS', 'YEAR_AT', 'MONTH_AT'], 'integer'],
			[['ACCESS_GROUP'], 'string', 'max' => 15],
			[['STORE_ID'], 'string', 'max' => 25],
			[['STORE_NM', 'PIC'], 'string', 'max' => 100],
			[['PROVINCE_NM', 'CITY_NAME', 'TLP', 'FAX', 'CREATE_BY', 'UPDATE_BY'], 'string', 'max' => 50],           
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => Yii::t('app', 'ID'),
			'ACCESS_ID' => Yii::t('app', 'ACCESS_UNIX'),
            'CREATE_BY' => Yii::t('app', 'CREATE BY'),
            'CREATE_AT' => Yii::t('app', 'CREATE AT'),
            'UPDATE_BY' => Yii::t('app', 'UPDATE BY'),
            'UPDATE_AT' => Yii::t('app', 'UPDATE AT'),
            'STATUS' => Yii::t('app', 'STATUS'),           
			'STORE_ID' => Yii::t('app', 'STORE CODE'),
			'STORE_NM' => Yii::t('app', 'OUTLET NAME'),
            
			'ALAMAT' => Yii::t('app', 'ALAMAT'),
			'PIC' => Yii::t('app', 'PIC'),
			'TLP' => Yii::t('app', 'TLP'),
			'FAX' => Yii::t('app', 'FAX'),
			//'ttltems' => Yii::t('app', 'Total Items'),
			//'Expired' => Yii::t('app', 'Expired')
        ];
    }
	
	//==PROVINCE==
	// public function getProvinsiTbl()
	// {
		// return $this->hasOne(LocateProvince::className(), ['PROVINCE_ID' => 'LOCATE_PROVINCE']);
	// }
	// public function getProvinsiNm()
	// {
		// return $this->provinsiTbl!=''?$this->provinsiTbl->PROVINCE:'none';
	// }
	
	//==CITY==
	// public function getKotaTbl()
	// {
		// return $this->hasOne(LocateKota::className(), ['CITY_ID' => 'LOCATE_CITY']);
	// }	
	// public function getKotaNm()
	// {
		// return $this->kotaTbl!=''?$this->kotaTbl->CITY_NAME:'none';
	// }
	/* public function getExpired()
	{
		return '30';
	}
	public function getTtltems()
	{
		return '12';
	} */
	
	
	
	
		
	public function fields()
	{
		return [			
			'ACCESS_ID'=>function($model){
				return $model->ACCESS_ID;
			},
			'CREATE_BY'=>function($model){
				return $model->CREATE_BY;
			},					
			'CREATE_AT'=>function($model){
				return $model->CREATE_AT;
			},	
			'UPDATE_BY'=>function($model){
				return $model->UPDATE_BY;
			},				
			'UPDATE_AT'=>function($model){
				return $model->UPDATE_AT;
			},	
			'STATUS'=>function($model){
				return $model->STATUS;
			},
			'STORE_ID'=>function($model){
				return $model->STORE_ID;
			},
			'STORE_NM'=>function($model){
				return $model->STORE_NM;
			},	
			'ALAMAT'=>function($model){
				return $model->ALAMAT;
			},		
			// 'PIC'=>function($model){
				// return $this->PIC;
			// },		
			// 'TLP'=>function($model){
				// return $model->TLP;
			// },		
			// 'FAX'=>function($model){
				// return $model->FAX;
			// },	
			// 'EXPIRED'=>function($model){
				// return $this->expired;
			// }		
		];
	}
	
	//Join TABLE ITEM
	/* public function getItems(){
		//return $this->hasMany(Item::className(), ['OUTLET_CODE' => 'OUTLET_CODE']);//->from(['formula' => Item::tableName()]);
		return $this->hasMany(Item::className(), ['OUTLET_CODE' => 'OUTLET_CODE']);
		//PR STATUS=1
		//return $this->hasMany(ItemFormulaDetail::className(), ['FORMULA_ID' => 'FORMULA_ID'],['STATUS' => '1']);//->from(['formula' => Item::tableName()]);
	} */
	
	/* public function extraFields()
	{
		return ['items','harga'];
		//return ['unit'];
	} */
}
