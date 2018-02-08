<?php
namespace frontend\backend\sistem\models;

 
use Yii;
 
class Product extends \yii\db\ActiveRecord
{
    use \kartik\tree\models\TreeTrait {
        isDisabled as parentIsDisabled; // note the alias
    }
 
    /**
     * @var string the classname for the TreeQuery that implements the NestedSetQueryBehavior.
     * If not set this will default to `kartik	ree\models\TreeQuery`.
     */
    public static $treeQueryClass; // change if you need to set your own TreeQuery
 
    /**
     * @var bool whether to HTML encode the tree node names. Defaults to `true`.
     */
    public $encodeNodeNames = true;
 
    /**
     * @var bool whether to HTML purify the tree node icon content before saving.
     * Defaults to `true`.
     */
    public $purifyNodeIcons = true;
 
    /**
     * @var array activation errors for the node
     */
    public $nodeActivationErrors = [];
 
    /**
     * @var array node removal errors
     */
    public $nodeRemovalErrors = [];
 
    /**
     * @var bool attribute to cache the `active` state before a model update. Defaults to `true`.
     */
    public $activeOrig = true;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }
      /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['STORE_ID', 'PRODUCT_ID', 'YEAR_AT', 'MONTH_AT'], 'required'],
            [['PRODUCT_SIZE', 'STOCK_LEVEL', 'CURRENT_STOCK', 'CURRENT_HPP', 'CURRENT_PRICE', 'CURRENT_PPN'], 'number'],
            [['INDUSTRY_ID', 'INDUSTRY_GRP_ID', 'STATUS', 'YEAR_AT', 'MONTH_AT'], 'integer'],
            [['CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['DCRP_DETIL'], 'string'],
            [['ACCESS_GROUP'], 'string', 'max' => 15],
            [['STORE_ID'], 'string', 'max' => 20],
            [['GROUP_ID', 'PRODUCT_QR', 'PRODUCT_NM', 'PRODUCT_HEADLINE'], 'string', 'max' => 100],
            [['PRODUCT_ID'], 'string', 'max' => 35],
            [['PRODUCT_WARNA', 'PRODUCT_SIZE_UNIT', 'UNIT_ID', 'CREATE_BY', 'UPDATE_BY'], 'string', 'max' => 50],
            [['INDUSTRY_NM', 'INDUSTRY_GRP_NM', 'IMG_FILE', 'CREATE_UUID', 'UPDATE_UUID'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'ACCESS_GROUP' => 'Access  Group',
            'STORE_ID' => 'Store  ID',
            'GROUP_ID' => 'Group  ID',
            'PRODUCT_ID' => 'Product  ID',
            'PRODUCT_QR' => 'Product  Qr',
            'PRODUCT_NM' => 'Product  Nm',
            'PRODUCT_WARNA' => 'Product  Warna',
            'PRODUCT_SIZE' => 'Product  Size',
            'PRODUCT_SIZE_UNIT' => 'Product  Size  Unit',
            'PRODUCT_HEADLINE' => 'Product  Headline',
            'UNIT_ID' => 'Unit  ID',
            'STOCK_LEVEL' => 'Stock  Level',
            'CURRENT_STOCK' => 'Current  Stock',
            'CURRENT_HPP' => 'Current  Hpp',
            'CURRENT_PRICE' => 'Current  Price',
            'INDUSTRY_ID' => 'Industry  ID',
            'INDUSTRY_NM' => 'Industry  Nm',
            'INDUSTRY_GRP_ID' => 'Industry  Grp  ID',
            'INDUSTRY_GRP_NM' => 'Industry  Grp  Nm',
            'IMG_FILE' => 'Img  File',
            'CREATE_BY' => 'Create  By',
            'CREATE_AT' => 'Create  At',
            'UPDATE_BY' => 'Update  By',
            'UPDATE_AT' => 'Update  At',
            'CREATE_UUID' => 'Create  Uuid',
            'UPDATE_UUID' => 'Update  Uuid',
            'STATUS' => 'Status',
            'DCRP_DETIL' => 'Dcrp  Detil',
            'YEAR_AT' => 'Year  At',
            'MONTH_AT' => 'Month  At',
            'CURRENT_PPN' => 'Current  Ppn',
        ];
    }
	public function getActive(){
		return true;
	}
	public function getSelected(){
		return true;
	}
	public function getCollapsed(){
		return true;
	}
	public function getVisible(){
		return true;
	}
	public function getReadonly(){
		return true;
	}
	public function getDisabled(){
		return true;
	}
	public function getRemovable(){
		return true;
	}
	public function getRemovable_all(){
		return true;
	}
	public function getMovable_u(){
		return true;
	}
	public function getMovable_d(){
		return true;
	}
	public function getMovable_l(){
		return true;
	}
	public function getMovable_r(){
		return true;
	}
    /**
     * Note overriding isDisabled method is slightly different when
     * using the trait. It uses the alias.
     */
    // public function isDisabled()
    // {
        // if (Yii::$app->user->username !== 'admin') {
            // return true;
        // }
        // return $this->parentIsDisabled();
    // }
}