<?php

namespace frontend\backend\master\models;

use Yii;

/**
 * This is the model class for table "product_group".
 *
 * @property string $ID
 * @property string $ACCESS_GROUP
 * @property string $STORE_ID
 * @property string $GROUP_ID
 * @property string $GROUP_NM
 * @property string $CREATE_BY USER pembuat
 * @property string $CREATE_AT Tanggal dibuat
 * @property string $UPDATE_BY user Ubah
 * @property string $UPDATE_AT Tanggal diubah
 * @property int $STATUS
 * @property string $NOTE
 * @property int $YEAR_AT partisi unix
 * @property int $MONTH_AT partisi unix
 */
class ProductGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['STORE_ID', 'GROUP_ID', 'YEAR_AT', 'MONTH_AT'], 'required'],
            [['CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['STATUS', 'YEAR_AT', 'MONTH_AT'], 'integer'],
            [['NOTE'], 'string'],
            [['ACCESS_GROUP'], 'string', 'max' => 15],
            [['STORE_ID'], 'string', 'max' => 25],
            [['GROUP_ID'], 'string', 'max' => 100],
            [['GROUP_NM'], 'string', 'max' => 255],
            [['CREATE_BY', 'UPDATE_BY'], 'string', 'max' => 50],
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
            'GROUP_NM' => 'Group  Nm',
            'CREATE_BY' => 'Create  By',
            'CREATE_AT' => 'Create  At',
            'UPDATE_BY' => 'Update  By',
            'UPDATE_AT' => 'Update  At',
            'STATUS' => 'Status',
            'NOTE' => 'Note',
            'YEAR_AT' => 'Year  At',
            'MONTH_AT' => 'Month  At',
        ];
    }
}
