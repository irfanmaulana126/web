<?php

namespace frontend\backend\laporan\models;

use Yii;
use frontend\backend\master\models\Store;

/**
 * This is the model class for table "jurnal_transaksi_c".
 *
 * @property string $JURNAL_BULAN
 * @property string $ACCESS_GROUP
 * @property string $STORE_ID
 * @property string $TRANS_DATE
 * @property int $TAHUN
 * @property int $BULAN
 * @property string $JUMLAH
 * @property int $STT_PAY
 * @property string $STT_NM
 * @property string $AKUN_CODE
 * @property string $AKUN_NM
 * @property int $KTG_CODE
 * @property string $KTG_NM
 * @property string $CREATE_AT
 * @property string $UPDATE_AT
 */
class JurnalTransaksiBulan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jurnal_transaksi_c';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['JURNAL_BULAN'], 'required'],
            [['TRANS_DATE','STORE_ID', 'CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['TAHUN', 'BULAN', 'STT_PAY', 'KTG_CODE'], 'integer'],
            [['JUMLAH'], 'number'],
            [['JURNAL_BULAN'], 'string', 'max' => 100],
            [['ACCESS_GROUP', 'AKUN_CODE'], 'string', 'max' => 15],
            [['STORE_ID'], 'string', 'max' => 20],
            [['STT_NM'], 'string', 'max' => 10],
            [['AKUN_NM', 'KTG_NM'], 'string', 'max' => 255],
            [['JURNAL_BULAN', 'ACCESS_GROUP', 'STORE_ID', 'AKUN_CODE', 'KTG_CODE', 'STT_PAY', 'TAHUN', 'BULAN'], 'unique', 'targetAttribute' => ['JURNAL_BULAN', 'ACCESS_GROUP', 'STORE_ID', 'AKUN_CODE', 'KTG_CODE', 'STT_PAY', 'TAHUN', 'BULAN']],
            [['JURNAL_BULAN'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'JURNAL_BULAN' => 'Jurnal  Bulan',
            'ACCESS_GROUP' => 'Access  Group',
            'STORE_ID' => 'Store  ID',
            'TRANS_DATE' => 'Trans  Date',
            'TAHUN' => 'Tahun',
            'BULAN' => 'Bulan',
            'JUMLAH' => 'Jumlah',
            'STT_PAY' => 'Stt  Pay',
            'STT_NM' => 'Stt  Nm',
            'AKUN_CODE' => 'Akun  Code',
            'AKUN_NM' => 'Akun  Nm',
            'KTG_CODE' => 'Ktg  Code',
            'KTG_NM' => 'Ktg  Nm',
            'CREATE_AT' => 'Create  At',
            'UPDATE_AT' => 'Update  At',
        ];
    }
    public function getStore()
    {
      return $this->hasOne(Store::className(),['STORE_ID'=>'STORE_ID']);
       
    }
    public function getSTORE_NM(){
        $result=$this->store;
        return $result!=''?$result->STORE_NM:'';
    }
}
