<?php

namespace frontend\backend\master\models;

use Yii;

/**
 * This is the model class for table "supplier".
 *
 * @property string $SUPPLIER_ID
 * @property string $SUPPLIER_NM
 * @property string $ACCESS_GROUP
 * @property string $ALAMAT
 * @property string $EMAIL
 * @property string $NO_TLP
 * @property string $PIC
 * @property string $PHONE
 * @property int $STATUS
 * @property string $DCRP_DETIL
 * @property string $CREATE_BY
 * @property string $CREATE_AT
 * @property string $UPDATE_BY
 * @property string $UPDATE_AT
 * @property int $YEAR_AT
 * @property int $MONTH_AT
 */
class Supplier extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'supplier';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SUPPLIER_ID', 'YEAR_AT', 'MONTH_AT'], 'required'],
            [['STATUS', 'YEAR_AT', 'MONTH_AT'], 'integer'],
            [['DCRP_DETIL'], 'string'],
            [['CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['SUPPLIER_ID', 'ACCESS_GROUP', 'ALAMAT', 'NO_TLP', 'PIC', 'PHONE', 'CREATE_BY'], 'string', 'max' => 100],
            [['SUPPLIER_NM'], 'string', 'max' => 155],
            [['EMAIL'], 'string', 'max' => 150],
            [['UPDATE_BY'], 'string', 'max' => 255],
            [['SUPPLIER_ID'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'SUPPLIER_ID' => 'Supplier  ID',
            'SUPPLIER_NM' => 'Supplier  Nm',
            'ACCESS_GROUP' => 'Access  Group',
            'ALAMAT' => 'Alamat',
            'EMAIL' => 'Email',
            'NO_TLP' => 'No  Tlp',
            'PIC' => 'Pic',
            'PHONE' => 'Phone',
            'STATUS' => 'Status',
            'DCRP_DETIL' => 'Dcrp  Detil',
            'CREATE_BY' => 'Create  By',
            'CREATE_AT' => 'Create  At',
            'UPDATE_BY' => 'Update  By',
            'UPDATE_AT' => 'Update  At',
            'YEAR_AT' => 'Year  At',
            'MONTH_AT' => 'Month  At',
        ];
    }
}
