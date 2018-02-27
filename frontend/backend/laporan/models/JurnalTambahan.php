<?php

namespace frontend\backend\laporan\models;

use Yii;
use frontend\backend\master\models\Store;

/**
 * This is the model class for table "jurnal_tambahan".
 *
 * @property string $JURNAL_ID
 * @property string $ACCESS_GROUP
 * @property string $STORE_ID
 * @property string $TRANS_DATE
 * @property int $STT_PAY
 * @property string $STT_PAY_NM
 * @property string $AKUN_CODE
 * @property string $AKUN_NM
 * @property int $KTG_CODE
 * @property string $KTG_NM
 * @property string $JUMLAH_TOTAL
 * @property string $JUMLAH_PEMBAGIAN
 * @property int $FREKUENSI 1=harian;2=mingguan;3=bulanan;4=tahunan;
 * @property string $FREKUENSI_NM
 * @property string $RANGE_TGL1
 * @property string $RANGE_TGL2
 * @property string $CREATE_AT
 * @property string $UPDATE_AT
 * @property int $MONTH_AT
 * @property int $YEAR_AT
 */
class JurnalTambahan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jurnal_tambahan';
    }

    /**
     * @inheritdoc
     */
    
    public function rules()
    {
        return [
            [['JURNAL_ID', 'ACCESS_GROUP', 'STORE_ID', 'TRANS_DATE', 'MONTH_AT', 'YEAR_AT'], 'required'],
            [['TRANS_DATE', 'RANGE_TGL1', 'RANGE_TGL2', 'CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['STT_PAY', 'KTG_CODE', 'FREKUENSI', 'MONTH_AT', 'YEAR_AT'], 'integer'],
            [['JUMLAH_TOTAL', 'JUMLAH_PEMBAGIAN'], 'number'],
            [['JURNAL_ID'], 'string', 'max' => 100],
            [['ACCESS_GROUP', 'AKUN_CODE'], 'string', 'max' => 15],
            [['STORE_ID'], 'string', 'max' => 20],
            [['STT_PAY_NM'], 'string', 'max' => 10],
            [['AKUN_NM', 'KTG_NM'], 'string', 'max' => 255],
            [['FREKUENSI_NM'], 'string', 'max' => 50],
            [['JURNAL_ID', 'ACCESS_GROUP', 'STORE_ID', 'TRANS_DATE', 'MONTH_AT', 'YEAR_AT'], 'unique', 'targetAttribute' => ['JURNAL_ID', 'ACCESS_GROUP', 'STORE_ID', 'TRANS_DATE', 'MONTH_AT', 'YEAR_AT']],
            [['JURNAL_ID', 'MONTH_AT', 'YEAR_AT'], 'unique', 'targetAttribute' => ['JURNAL_ID', 'MONTH_AT', 'YEAR_AT']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'JURNAL_ID' => 'Jurnal  ID',
            'ACCESS_GROUP' => 'Access  Group',
            'STORE_ID' => 'Store  ID',
            'TRANS_DATE' => 'Trans  Date',
            'STT_PAY' => 'PAY',
            'STT_PAY_NM' => 'PAY',
            'AKUN_CODE' => 'KODE AKUN',
            'AKUN_NM' => 'NAMA AKUN',
            'KTG_CODE' => 'KATEGORI',
            'KTG_NM' => 'NAMA KATEGORI',
            'JUMLAH_TOTAL' => 'JUMLAH',
            'JUMLAH_PEMBAGIAN' => 'JUMLAH PEMBAGIAN',
            'FREKUENSI' => 'FREKUENSI',
            'FREKUENSI_NM' => 'Frekuensi  Nm',
            'RANGE_TGL1' => 'Range  Tgl1',
            'RANGE_TGL2' => 'Range  Tgl2',
            'CREATE_AT' => 'Create  At',
            'UPDATE_AT' => 'Update  At',
            'MONTH_AT' => 'Month  At',
            'YEAR_AT' => 'Year  At',
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
