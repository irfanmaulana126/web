<?php

namespace frontend\backend\sistem\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property string $ID
 * @property string $ACCESS_GROUP
 * @property string $STORE_ID
 * @property string $GROUP_ID
 * @property string $PRODUCT_ID
 * @property string $PRODUCT_QR Untuk barcode sendiri
 * @property string $PRODUCT_NM
 * @property string $PRODUCT_WARNA
 * @property string $PRODUCT_SIZE nilai isi 
 * @property string $PRODUCT_SIZE_UNIT satuan ukuran isi; join tbl satuan.UNIT_ID
 * @property string $PRODUCT_HEADLINE keterangan header prodak item
 * @property string $UNIT_ID id satuan dalam jual; join tbl satuan.UNIT_ID
 * @property double $STOCK_LEVEL Minimum Stock Notify
 * @property double $CURRENT_STOCK
 * @property string $CURRENT_HPP
 * @property string $CURRENT_PRICE
 * @property string $INDUSTRY_ID
 * @property string $INDUSTRY_NM
 * @property string $INDUSTRY_GRP_ID
 * @property string $INDUSTRY_GRP_NM
 * @property string $IMG_FILE
 * @property string $CREATE_BY USER pembuat
 * @property string $CREATE_AT Tanggal dibuat
 * @property string $UPDATE_BY user Ubah
 * @property string $UPDATE_AT Tanggal diubah
 * @property string $CREATE_UUID
 * @property string $UPDATE_UUID
 * @property int $STATUS
 * @property string $DCRP_DETIL
 * @property int $YEAR_AT partisi unix
 * @property int $MONTH_AT partisi unix
 * @property string $CURRENT_PPN
 */
class Product extends \kartik\tree\models\Tree
{
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
}
