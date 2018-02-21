<?php

namespace frontend\backend\laporan\models;

use Yii;

/**
 * This is the model class for table "jurnal_akun".
 *
 * @property string $AKUN_CODE
 * @property string $AKUN_NM
 * @property int $KTG_CODE
 * @property string $KTG_NM
 * @property int $STATUS
 * @property string $KETERANGAN
 */
class JurnalAkun extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jurnal_akun';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['AKUN_CODE'], 'required'],
            [['KTG_CODE', 'STATUS'], 'integer'],
            [['KETERANGAN'], 'string'],
            [['AKUN_CODE'], 'string', 'max' => 15],
            [['AKUN_NM'], 'string', 'max' => 100],
            [['KTG_NM'], 'string', 'max' => 150],
            [['AKUN_CODE'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'AKUN_CODE' => 'Akun  Code',
            'AKUN_NM' => 'Akun  Nm',
            'KTG_CODE' => 'Ktg  Code',
            'KTG_NM' => 'Ktg  Nm',
            'STATUS' => 'Status',
            'KETERANGAN' => 'Keterangan',
        ];
    }
}
