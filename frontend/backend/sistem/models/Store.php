<?php

namespace frontend\backend\sistem\models;

use Yii;

use frontend\backend\master\models\User;
/**
 * This is the model class for table "store".
 *
 * @property string $ID RECEVED & RELEASE:
 ID UNIX, POSTING URL DAN AJAX
 * @property string $ACCESS_GROUP
 * @property string $STORE_ID
 * @property string $STORE_NM
 * @property string $ACCESS_ID ACCESS_ID - Array 
 * @property string $UUID
 * @property resource $PLAYER_ID
 * @property string $DATE_START TANGGAL PEMBAYARAN
 * @property string $DATE_END TANGGAL AKHIR PEMBAYARAN.
 FORMULA
  1. Jumlah Pembayaran
  2. lama waktu aktif.
  3. 8 Hari sebelum berakhir masa tengang.
      a. create invoice.
      b. show list masa tengang.
      c. send invoice email.
      d. prosess pembayaran
 * @property string $PROVINCE_ID
 * @property string $PROVINCE_NM
 * @property string $CITY_ID
 * @property string $CITY_NAME
 * @property double $LATITUDE
 * @property double $LONGITUDE
 * @property string $ALAMAT
 * @property string $PIC
 * @property string $TLP
 * @property string $FAX
 * @property string $PPN
 * @property string $INDUSTRY_ID
 * @property string $INDUSTRY_NM
 * @property string $INDUSTRY_GRP_ID
 * @property string $INDUSTRY_GRP_NM
 * @property string $CREATE_BY USER pembuat
 * @property string $CREATE_AT Tanggal dibuat
 * @property string $UPDATE_BY user Ubah
 * @property string $UPDATE_AT Tanggal diubah
 * @property int $STATUS 0=TRIAL (30 hari)
 ;1=Active;
 2=Deactive (BALUM BAYAR)
 3=Delete
 * @property string $DCRP_DETIL
 * @property int $YEAR_AT partisi unix
 * @property int $MONTH_AT partisi unix
 */
class Store extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'store';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['STORE_ID', 'YEAR_AT', 'MONTH_AT'], 'required'],
            [['ACCESS_ID', 'UUID', 'PLAYER_ID', 'ALAMAT', 'DCRP_DETIL'], 'string'],
            [['DATE_START', 'DATE_END', 'CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['PROVINCE_ID', 'CITY_ID', 'INDUSTRY_ID', 'INDUSTRY_GRP_ID', 'STATUS', 'YEAR_AT', 'MONTH_AT'], 'integer'],
            [['LATITUDE', 'LONGITUDE', 'PPN'], 'number'],
            [['ACCESS_GROUP'], 'string', 'max' => 15],
            [['STORE_ID'], 'string', 'max' => 25],
            [['STORE_NM', 'PIC'], 'string', 'max' => 100],
            [['PROVINCE_NM', 'CITY_NAME', 'TLP', 'FAX', 'CREATE_BY', 'UPDATE_BY'], 'string', 'max' => 50],
            [['INDUSTRY_NM', 'INDUSTRY_GRP_NM'], 'string', 'max' => 255],
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
            'STORE_NM' => 'Store  Nm',
            'ACCESS_ID' => 'Access  ID',
            'UUID' => 'Uuid',
            'PLAYER_ID' => 'Player  ID',
            'DATE_START' => 'Date  Start',
            'DATE_END' => 'Date  End',
            'PROVINCE_ID' => 'Province  ID',
            'PROVINCE_NM' => 'Province  Nm',
            'CITY_ID' => 'City  ID',
            'CITY_NAME' => 'City  Name',
            'LATITUDE' => 'Latitude',
            'LONGITUDE' => 'Longitude',
            'ALAMAT' => 'Alamat',
            'PIC' => 'Pic',
            'TLP' => 'Tlp',
            'FAX' => 'Fax',
            'PPN' => 'Ppn',
            'INDUSTRY_ID' => 'Industry  ID',
            'INDUSTRY_NM' => 'Industry  Nm',
            'INDUSTRY_GRP_ID' => 'Industry  Grp  ID',
            'INDUSTRY_GRP_NM' => 'Industry  Grp  Nm',
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
    public function getUser()
    {
        return $this->hasOne(User::className(),['ACCESS_GROUP'=>'ACCESS_GROUP']);
    }

    public function getOwner(){
        $result=$this->user;
        $result = (empty($result->ACCESS_LEVEL)) ? '' : $result->ACCESS_LEVEL ;
        return $result;
    }
}
