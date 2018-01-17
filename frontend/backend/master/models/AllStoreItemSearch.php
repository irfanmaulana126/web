<?php

namespace frontend\backend\master\models;

use Yii;
use yii\base\Model;
//use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\debug\components\search\Filter;
use yii\debug\components\search\matchers;

class AllStoreItemSearch extends Model
{	
	public $CURRENT_STOCK;
	public $ACCESS_GROUP;
	public $PRODUCT_ID;
    public $STORE_NM;
    public $PRODUCT_NM;
    public $CURRENT_PRICE;
    public $PRODUCT_SIZE_UNIT;
    /**
     * @inheritdoc	
     */
    public function rules()
    {
        return [
            [['STORE_NM','CURRENT_STOCK','ACCESS_GROUP','PRODUCT_ID'], 'safe'],
            [['PRODUCT_NM','CURRENT_PRICE','PRODUCT_SIZE_UNIT'], 'safe'],
        ];
    }

	public function attributeLabels()
    {
        return [
            'ID' => Yii::t('app', 'KODE PRODUCT'),
            'STORE_NM'=>Yii::t('app','STORE NAMA'),
            'ACCESS_GROUP' => Yii::t('app', 'AKSES GROUP'),
            'PRODUCT_ID' => Yii::t('app', 'KODE PRODUCT'),
            'PRODUCT_NM' => Yii::t('app', 'NAMA PRODUCT'),
            'CURRENT_STOCK' => Yii::t('app', 'STOCK'),
            'PRODUCT_SIZE_UNIT'=> Yii::t('app','PRODUCT SIZE UNIT'),
            'CURRENT_PRICE'=>Yii::t('app','CURRENT PRICE')
        ];
    }
	
    public function search($params){
		
		//$this->OUTLET_CODE='0001';
		$this->ACCESS_GROUP=Yii::$app->user->identity->ACCESS_GROUP;
        $qryAllStoreItems= Yii::$app->api_dbkg->createCommand("
            SELECT a.*,b.STORE_NM FROM `product` as a INNER JOIN store as b on a.STORE_ID=b.STORE_ID WHERE a.ACCESS_GROUP='".$this->ACCESS_GROUP."' ORDER BY STORE_ID ASC;
            ")->queryAll();
		// $qryAllStoreItems= Yii::$app->db->createCommand("select * from VwStoreItem where ACCESS_UNIX_ITEM='".$this->ACCESS_UNIX_ITEM."' AND OUTLET_CODE='".$this->OUTLET_CODE."'")->queryAll();
		
		$dataProvider= new ArrayDataProvider([
			'allModels'=>$qryAllStoreItems,			
			'pagination' => [
				'pageSize' => 500,
			]
		]);
		if (!($this->load($params) && $this->validate())) {
 			return $dataProvider;
 		}
		
		$filter = new Filter();
 		$this->addCondition($filter, 'STORE_NM', true);
 		$this->addCondition($filter, 'PRODUCT_NM', true);	
 		$this->addCondition($filter, 'CURRENT_STOCK', true);	
 		$this->addCondition($filter, 'CURRENT_PRICE', true);	
         $this->addCondition($filter, 'PRODUCT_SIZE_UNIT', true);
 		$dataProvider->allModels = $filter->filter($qryAllStoreItems);
		
		return $dataProvider;
	}
	
	public function addCondition(Filter $filter, $attribute, $partial = false)
    {
        $value = $this->$attribute;

        if (mb_strpos($value, '>') !== false) {
            $value = intval(str_replace('>', '', $value));
            $filter->addMatcher($attribute, new matchers\GreaterThan(['value' => $value]));

        } elseif (mb_strpos($value, '<') !== false) {
            $value = intval(str_replace('<', '', $value));
            $filter->addMatcher($attribute, new matchers\LowerThan(['value' => $value]));
        } else {
            $filter->addMatcher($attribute, new matchers\SameAs(['value' => $value, 'partial' => $partial]));
        }
    }
	
	public function addConditionX(Filter $filter, $attribute, $partial = false)
    {
        $value = $this->$attribute;

        if (mb_strpos($value, '>') !== false) {
            $value = intval(str_replace('>', '', $value));
            $filter->addMatcher($attribute, new matchers\GreaterThan(['value' => $value]));

        } elseif (mb_strpos($value, '<') !== false) {
            $value = intval(str_replace('<', '', $value));
            $filter->addMatcher($attribute, new matchers\LowerThan(['value' => $value]));
        } else {
            $filter->addMatcher($attribute, new matchers\SameAs(['value' => $value, 'partial' => $partial]));
        }
    }
	
	
	
	
	
	
	
	
	
	
	
}
