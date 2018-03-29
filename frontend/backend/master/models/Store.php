<?php

namespace frontend\backend\master\models;

use Yii;
use frontend\backend\master\models\User;
use yii\data\ArrayDataProvider;
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
            [['STORE_ID', 'YEAR_AT', 'MONTH_AT','STORE_NM', 'PIC', 'TLP', 'FAX', 'INDUSTRY_ID', 'INDUSTRY_GRP_ID'], 'required'],
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
            'ACCESS_GROUP' => 'ACCESS GROUP',
            'STORE_ID' => 'STORE ID',
            'STORE_NM' => 'NAMA STORE',
            'ACCESS_ID' => 'ACCESS ID',
            'UUID' => 'Uuid',
            'PLAYER_ID' => 'Player  ID',
            'DATE_START' => 'DATE START',
            'DATE_END' => 'DATE  END',
            'PROVINCE_ID' => 'PROVINSI',
            'PROVINCE_NM' => 'PROVINSI',
            'CITY_ID' => 'KOTA',
            'CITY_NAME' => 'KOTA',
            'LATITUDE' => 'LATITUDE',
            'LONGITUDE' => 'LONGITUDE',
            'ALAMAT' => 'ALAMAT',
            'PIC' => 'PIC',
            'TLP' => 'TLP',
            'FAX' => 'Fax',
            'PPN' => 'PPN',
            'INDUSTRY_ID' => 'INDUSTRI  ID',
            'INDUSTRY_NM' => 'INDUSTRI',
            'INDUSTRY_GRP_ID' => 'INDUSTRI GROUP ID',
            'INDUSTRY_GRP_NM' => 'INDUSTRI Group',
            'CREATE_BY' => 'Create  By',
            'CREATE_AT' => 'Create  At',
            'UPDATE_BY' => 'Update  By',
            'UPDATE_AT' => 'Update  At',
            'STATUS' => 'STATUS',
            'DCRP_DETIL' => 'DESKRIPSI',
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
    public function searchExcelExport($params)
    {
        $query = "SELECT `STORE_NM`,`PROVINCE_NM`,`CITY_NAME`,`LATITUDE`,`LONGITUDE`,`ALAMAT`,`PIC`,`TLP`,`FAX`,`INDUSTRY_NM`,`INDUSTRY_GRP_NM`,`DCRP_DETIL`, CASE WHEN `STATUS` = 0 THEN 'TRIAL' WHEN `STATUS` = 1 THEN 'ACTIVE' WHEN `STATUS` = 2 THEN 'DEACTIVE' ELSE 'DELETE' END FROM store WHERE ACCESS_GROUP=".Yii::$app->user->identity->ACCESS_GROUP."";
       $qrySql= Yii::$app->db->createCommand($query)->queryAll();
        $dataProvider = new ArrayDataProvider([
            'allModels' => $qrySql,
        ]);

        return $dataProvider;
    }
}
