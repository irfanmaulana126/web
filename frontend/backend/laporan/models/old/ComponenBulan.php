<?php

namespace frontend\backend\laporan\models;

use Yii;

/**
 * This is the model class for table "componen_bulan".
 *
 * @property integer $BULAN_ID
 * @property string $BULAN_NM
 */
class ComponenBulan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'componen_bulan';
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
            [['BULAN_ID'], 'required'],
            [['BULAN_ID'], 'integer'],
            [['BULAN_NM'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'BULAN_ID' => 'Bulan',
            'BULAN_NM' => 'Bulan  Nm',
        ];
    }
}
