<?php

namespace frontend\backend\hris\models;

use Yii;
use common\models\Store;
/**
 * This is the model class for table "hrd_absen_rekap".
 *
 * @property string $ID
 * @property string $ACCESS_GROUP
 * @property string $STORE_ID
 * @property string $KARYAWAN_ID
 * @property string $KARYAWAN
 * @property string $TGL
 * @property string $WAKTU_MASUK
 * @property string $WAKTU_KELUAR
 * @property integer $SHIFT_ID
 * @property string $SHIFT_NM
 * @property string $SHIFT_IN
 * @property string $SHIFT_OUT
 * @property string $SHIFT_TELAT
 * @property string $SHIFT_PULANG
 * @property double $SHIFT_RADIUS
 * @property string $SELISIH_TELAT
 * @property string $SELISIH_AWALPULANG
 * @property string $KELEBIHAN_WAKTU
 * @property string $IZIN_STT
 * @property string $IZIN_STT_NM
 * @property integer $IZIN
 * @property string $IZIN_NM
 * @property double $MASUK_LAT
 * @property double $MASUK_LAG
 * @property double $MASUK_RADIUS
 * @property double $PULANG_LAT
 * @property double $PULANG_LAG
 * @property double $PULANG_RADIUS
 * @property integer $ACTIVE_TELAT
 * @property integer $ACTIVE_PULANG
 * @property integer $ACTIVE_IZIN
 * @property string $POT_PERSEN_TELAT
 * @property string $POT_RUPIAH_TELAT
 * @property string $POT_JAM_TELAT
 * @property string $POT_PERSEN_PULANG
 * @property string $POT_RUPIAH_PULANG
 * @property string $POT_JAM_PULANG
 * @property string $LEMBUR_PERSEN
 * @property string $LEMBUR_RUPIAH
 * @property string $LEMBUR_JAM
 * @property string $UPAH_HARIAN
 * @property string $ID_TELAT
 * @property string $ID_AWALPULANG
 * @property string $IN_ABSENID
 * @property string $OUT_ABSENID
 * @property integer $IN_SEQ
 * @property integer $SEQ_SHIFT
 * @property string $ID_LEMBUR
 * @property string $CREATE_BY
 * @property string $CREATE_AT
 * @property string $UPDATE_BY
 * @property string $UPDATE_AT
 * @property integer $STATUS
 * @property string $DCRP_DETIL
 * @property integer $YEAR_AT
 * @property integer $MONTH_AT
 */
class AbsenRekap extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hrd_absen_rekap';
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
            [['STORE_ID', 'KARYAWAN_ID', 'YEAR_AT', 'MONTH_AT'], 'required'],
            [['TGL', 'WAKTU_MASUK', 'WAKTU_KELUAR', 'SHIFT_IN', 'SHIFT_OUT', 'SHIFT_TELAT', 'SHIFT_PULANG', 'SELISIH_TELAT', 'SELISIH_AWALPULANG', 'KELEBIHAN_WAKTU', 'POT_JAM_TELAT', 'POT_JAM_PULANG', 'LEMBUR_JAM', 'CREATE_AT', 'UPDATE_AT','storeNm'], 'safe'],
            [['SHIFT_ID', 'IZIN_STT', 'IZIN', 'ACTIVE_TELAT', 'ACTIVE_PULANG', 'ACTIVE_IZIN', 'IN_SEQ', 'SEQ_SHIFT', 'STATUS', 'YEAR_AT', 'MONTH_AT'], 'integer'],
            [['SHIFT_RADIUS', 'MASUK_LAT', 'MASUK_LAG', 'MASUK_RADIUS', 'PULANG_LAT', 'PULANG_LAG', 'PULANG_RADIUS', 'POT_PERSEN_TELAT', 'POT_RUPIAH_TELAT', 'POT_PERSEN_PULANG', 'POT_RUPIAH_PULANG', 'LEMBUR_PERSEN', 'LEMBUR_RUPIAH', 'UPAH_HARIAN'], 'number'],
            [['DCRP_DETIL'], 'string'],
            [['ACCESS_GROUP'], 'string', 'max' => 15],
            [['STORE_ID'], 'string', 'max' => 25],
            [['KARYAWAN_ID'], 'string', 'max' => 30],
            [['KARYAWAN'], 'string', 'max' => 150],
            [['SHIFT_NM', 'IZIN_STT_NM', 'IZIN_NM', 'ID_TELAT', 'ID_AWALPULANG', 'IN_ABSENID', 'OUT_ABSENID', 'ID_LEMBUR', 'CREATE_BY', 'UPDATE_BY'], 'string', 'max' => 50],
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
            'KARYAWAN_ID' => 'Karyawan  ID',
            'KARYAWAN' => 'Karyawan',
            'TGL' => 'Tgl',
            'WAKTU_MASUK' => 'Waktu  Masuk',
            'WAKTU_KELUAR' => 'Waktu  Keluar',
            'SHIFT_ID' => 'Shift  ID',
            'SHIFT_NM' => 'Shift  Nm',
            'SHIFT_IN' => 'Shift  In',
            'SHIFT_OUT' => 'Shift  Out',
            'SHIFT_TELAT' => 'Shift  Telat',
            'SHIFT_PULANG' => 'Shift  Pulang',
            'SHIFT_RADIUS' => 'Shift  Radius',
            'SELISIH_TELAT' => 'Selisih  Telat',
            'SELISIH_AWALPULANG' => 'Selisih  Awalpulang',
            'KELEBIHAN_WAKTU' => 'Kelebihan  Waktu',
            'IZIN_STT' => 'Izin  Stt',
            'IZIN_STT_NM' => 'Izin  Stt  Nm',
            'IZIN' => 'Izin',
            'IZIN_NM' => 'Izin  Nm',
            'MASUK_LAT' => 'Masuk  Lat',
            'MASUK_LAG' => 'Masuk  Lag',
            'MASUK_RADIUS' => 'Masuk  Radius',
            'PULANG_LAT' => 'Pulang  Lat',
            'PULANG_LAG' => 'Pulang  Lag',
            'PULANG_RADIUS' => 'Pulang  Radius',
            'ACTIVE_TELAT' => 'Active  Telat',
            'ACTIVE_PULANG' => 'Active  Pulang',
            'ACTIVE_IZIN' => 'Active  Izin',
            'POT_PERSEN_TELAT' => 'Pot  Persen  Telat',
            'POT_RUPIAH_TELAT' => 'Pot  Rupiah  Telat',
            'POT_JAM_TELAT' => 'Pot  Jam  Telat',
            'POT_PERSEN_PULANG' => 'Pot  Persen  Pulang',
            'POT_RUPIAH_PULANG' => 'Pot  Rupiah  Pulang',
            'POT_JAM_PULANG' => 'Pot  Jam  Pulang',
            'LEMBUR_PERSEN' => 'Lembur  Persen',
            'LEMBUR_RUPIAH' => 'Lembur  Rupiah',
            'LEMBUR_JAM' => 'Lembur  Jam',
            'UPAH_HARIAN' => 'Upah  Harian',
            'ID_TELAT' => 'Id  Telat',
            'ID_AWALPULANG' => 'Id  Awalpulang',
            'IN_ABSENID' => 'In  Absenid',
            'OUT_ABSENID' => 'Out  Absenid',
            'IN_SEQ' => 'In  Seq',
            'SEQ_SHIFT' => 'Seq  Shift',
            'ID_LEMBUR' => 'Id  Lembur',
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
	
	public function getStoreTbl(){
		return $this->hasOne(Store::className(), ['STORE_ID' => 'STORE_ID']);
	}	
	public function getStoreNm(){
		$rslt = $this->storeTbl['STORE_NM'];
		if ($rslt){
			return $rslt;
		}else{
			return "none";
		}; 
	}
}
