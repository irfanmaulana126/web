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
	public $STORE_ID;
    /**
     * @inheritdoc	
     */
    public function rules()
    {
        return [
            [['STORE_ID','CURRENT_STOCK','ACCESS_GROUP','PRODUCT_ID'], 'safe'],
            [['PRODUCT_NM'], 'safe'],
        ];
    }

	public function attributeLabels()
    {
        return [
            'ID' => Yii::t('app', 'ID'),
            'ACCESS_GROUP' => Yii::t('app', 'OUTLET'),
            'PRODUCT_ID' => Yii::t('app', 'ACCESS_UNIX'),
            'PRODUCT_NM' => Yii::t('app', 'ITEM_ID'),
            'CURRENT_STOCK' => Yii::t('app', 'ITEMS'),
            
        ];
    }
	
    public function search($params){
		
		//$this->OUTLET_CODE='0001';
		$this->ACCESS_GROUP=Yii::$app->user->identity->ACCESS_GROUP;
        $qryAllStoreItems= Yii::$app->api_dbkg->createCommand("
        
            select * from product where ACCESS_GROUP='".$this->ACCESS_GROUP."'
            order by store_id asc
            ")->queryAll();
		// $qryAllStoreItems= Yii::$app->db->createCommand("select * from VwStoreItem where ACCESS_UNIX_ITEM='".$this->ACCESS_UNIX_ITEM."' AND OUTLET_CODE='".$this->OUTLET_CODE."'")->queryAll();
		
		$dataProvider= new ArrayDataProvider([
			'allModels'=>$qryAllStoreItems	,			
			'pagination' => [
				'pageSize' => 500,
			]
		]);
		if (!($this->load($params) && $this->validate())) {
 			return $dataProvider;
 		}
		
		$filter = new Filter();
 		$this->addCondition($filter, 'ACCESS_GROUP', true);
 		$this->addCondition($filter, 'PRODUCT_ID', true);	
 		$this->addCondition($filter, 'PRODUCT_NM', true);	
 		$this->addCondition($filter, 'STOCK_LEVEL', true);	
 		$this->addCondition($filter, 'CURRENT_STOCK', true);	
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
