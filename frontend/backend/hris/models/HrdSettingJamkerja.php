<?php

namespace frontend\backend\hris\models;

use Yii;

/**
 * This is the model class for table "hrd_setting_jamkerja".
 *
 * @property string $ID
 * @property string $ACCESS_GROUP
 * @property string $STORE_ID
 * @property integer $SHIFT_ID
 * @property string $SHIFT_NM
 * @property string $RENTANG_BAWAH
 * @property string $RENTANG_ATAS
 * @property string $RENTANG_TENGAH
 * @property string $SHIFT_IN_BATAS_BAWAH
 * @property integer $SHIFT_IN_BATAS_SEQ
 * @property string $SHIFT_IN_BATAS_ATAS
 * @property string $SHIFT_IN
 * @property string $SHIFT_OUT
 * @property integer $SHIFT_SEQ
 * @property integer $RADIUS_KOORDINAT
 * @property integer $TOLERANSI_TELAT
 * @property integer $TOLERANSI_PULANG
 * @property string $CREATE_BY
 * @property string $CREATE_AT
 * @property string $UPDATE_BY
 * @property string $UPDATE_AT
 * @property integer $STATUS
 * @property string $DCRP_DETIL
 * @property integer $YEAR_AT
 * @property integer $MONTH_AT
 */
class HrdSettingJamkerja extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hrd_setting_jamkerja';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
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
            [['STORE_ID', 'YEAR_AT', 'MONTH_AT'], 'required'],
            [['SHIFT_ID', 'SHIFT_IN_BATAS_SEQ', 'SHIFT_SEQ', 'RADIUS_KOORDINAT', 'TOLERANSI_TELAT', 'TOLERANSI_PULANG', 'STATUS', 'YEAR_AT', 'MONTH_AT'], 'integer'],
            [['RENTANG_BAWAH', 'RENTANG_ATAS', 'RENTANG_TENGAH', 'SHIFT_IN_BATAS_BAWAH', 'SHIFT_IN_BATAS_ATAS', 'SHIFT_IN', 'SHIFT_OUT', 'CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['DCRP_DETIL'], 'string'],
            [['ACCESS_GROUP'], 'string', 'max' => 15],
            [['STORE_ID'], 'string', 'max' => 25],
            [['SHIFT_NM', 'CREATE_BY', 'UPDATE_BY'], 'string', 'max' => 50],
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
            'SHIFT_ID' => 'Shift  ID',
            'SHIFT_NM' => 'Shift  Nm',
            'RENTANG_BAWAH' => 'Rentang  Bawah',
            'RENTANG_ATAS' => 'Rentang  Atas',
            'RENTANG_TENGAH' => 'Rentang  Tengah',
            'SHIFT_IN_BATAS_BAWAH' => 'Shift  In  Batas  Bawah',
            'SHIFT_IN_BATAS_SEQ' => 'Shift  In  Batas  Seq',
            'SHIFT_IN_BATAS_ATAS' => 'Shift  In  Batas  Atas',
            'SHIFT_IN' => 'Shift  In',
            'SHIFT_OUT' => 'Shift  Out',
            'SHIFT_SEQ' => 'Shift  Seq',
            'RADIUS_KOORDINAT' => 'Radius  Koordinat',
            'TOLERANSI_TELAT' => 'Toleransi  Telat',
            'TOLERANSI_PULANG' => 'Toleransi  Pulang',
            'CREATE_BY' => 'Create  By',
            'CREATE_AT' => 'Create  At',
            'UPDATE_BY' => 'Update  By',
            'UPDATE_AT' => 'Update  At',
            'STATUS' => 'Status',
            'DCRP_DETIL' => 'Dcrp  Detil',
            'YEAR_AT' => 'Year  At',
            'MONTH_AT' => 'Month  At',
        ];
    }
}
