<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "hrd_absen_img".
 *
 * @property string $ID
 * @property string $ABSEN_ID
 * @property string $KARYAWAN_ID
 * @property string $ABSEN_IMAGE
 * @property string $CREATE_BY
 * @property string $CREATE_AT
 * @property string $UPDATE_BY
 * @property string $UPDATE_AT
 * @property integer $STATUS
 * @property string $DCRP_DETIL
 * @property integer $YEAR_AT
 * @property integer $MONTH_AT
 */
class HrdAbsenImg extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hrd_absen_img';
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
            [['ABSEN_ID', 'STATUS', 'YEAR_AT', 'MONTH_AT'], 'integer'],
            [['KARYAWAN_ID', 'YEAR_AT', 'MONTH_AT'], 'required'],
            [['ABSEN_IMAGE', 'DCRP_DETIL'], 'string'],
            [['CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['KARYAWAN_ID'], 'string', 'max' => 30],
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
            'ABSEN_ID' => 'Absen  ID',
            'KARYAWAN_ID' => 'Karyawan  ID',
            'ABSEN_IMAGE' => 'Absen  Image',
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
