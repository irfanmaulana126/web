<?php

namespace frontend\backend\laporan\models;

use Yii;
use frontend\backend\laporan\models\JurnalTransaksiBulan;

/**
 * This is the model class for table "jurnal_template_detail".
 *
 * @property string $RPT_DETAIL_ID
 * @property int $RPT_SORTING
 * @property string $ACCESS_GROUP
 * @property string $AKUN_CODE releationship table jurnal_akun
 * @property string $KTG_CODE
 * @property string $AKUN_NM
 * @property string $KTG_NM
 * @property int $RPT_TITLE_ID releationship table jurnal_template_title
 * @property string $RPT_TITLE_NM
 * @property int $RPT_GROUP_ID releationship table jurnal_template_report
 * @property string $RPT_GROUP_NM
 * @property int $CAL_FORMULA 0=minus; 1=plus; 2=perkalian
 * @property string $CAL_FORMULA_NM
 * @property int $STATUS 0=disable; 1=enable
 * @property string $STATUS_NM
 * @property string $KETERANGAN
 * @property string $CREATE_BY
 * @property string $UPDATE_BY
 * @property string $CREATE_AT
 * @property string $UPDATE_AT
 * @property int $MONTH_AT partition split bulan
 * @property int $YEAR_AT partition split tahun
 */
class JurnalTemplateDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jurnal_template_detail';
    }

    /**
     * @inheritdoc
     */
    public $STORE_ID;
    public function rules()
    {
        return [
            [['RPT_DETAIL_ID', 'AKUN_CODE', 'RPT_TITLE_ID', 'RPT_GROUP_ID', 'MONTH_AT', 'YEAR_AT'], 'required'],
            [['RPT_SORTING', 'RPT_TITLE_ID', 'RPT_GROUP_ID', 'CAL_FORMULA', 'STATUS', 'MONTH_AT', 'YEAR_AT'], 'integer'],
            [['KETERANGAN'], 'string'],
            [['CREATE_AT', 'UPDATE_AT','STORE_ID'], 'safe'],
            [['RPT_DETAIL_ID', 'AKUN_NM', 'KTG_NM', 'CREATE_BY', 'UPDATE_BY'], 'string', 'max' => 100],
            [['ACCESS_GROUP', 'CAL_FORMULA_NM'], 'string', 'max' => 50],
            [['AKUN_CODE', 'KTG_CODE', 'STATUS_NM'], 'string', 'max' => 15],
            [['RPT_TITLE_NM', 'RPT_GROUP_NM'], 'string', 'max' => 255],
            [['RPT_DETAIL_ID', 'ACCESS_GROUP', 'AKUN_CODE', 'RPT_TITLE_ID', 'RPT_GROUP_ID', 'MONTH_AT', 'YEAR_AT'], 'unique', 'targetAttribute' => ['RPT_DETAIL_ID', 'ACCESS_GROUP', 'AKUN_CODE', 'RPT_TITLE_ID', 'RPT_GROUP_ID', 'MONTH_AT', 'YEAR_AT']],
            [['RPT_DETAIL_ID', 'AKUN_CODE', 'RPT_TITLE_ID', 'RPT_GROUP_ID', 'MONTH_AT', 'YEAR_AT'], 'unique', 'targetAttribute' => ['RPT_DETAIL_ID', 'AKUN_CODE', 'RPT_TITLE_ID', 'RPT_GROUP_ID', 'MONTH_AT', 'YEAR_AT']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'RPT_DETAIL_ID' => 'Rpt  Detail  ID',
            'RPT_SORTING' => 'Rpt  Sorting',
            'ACCESS_GROUP' => 'Access  Group',
            'AKUN_CODE' => 'Akun  Code',
            'KTG_CODE' => 'Ktg  Code',
            'AKUN_NM' => 'Akun  Nm',
            'KTG_NM' => 'Ktg  Nm',
            'RPT_TITLE_ID' => 'Rpt  Title  ID',
            'RPT_TITLE_NM' => 'Rpt  Title  Nm',
            'RPT_GROUP_ID' => 'Rpt  Group  ID',
            'RPT_GROUP_NM' => 'Rpt  Group  Nm',
            'CAL_FORMULA' => 'Cal  Formula',
            'CAL_FORMULA_NM' => 'Cal  Formula  Nm',
            'STATUS' => 'Status',
            'STATUS_NM' => 'Status  Nm',
            'KETERANGAN' => 'Keterangan',
            'CREATE_BY' => 'Create  By',
            'UPDATE_BY' => 'Update  By',
            'CREATE_AT' => 'Create  At',
            'UPDATE_AT' => 'Update  At',
            'MONTH_AT' => 'Month  At',
            'YEAR_AT' => 'Year  At',
        ];
    }
    public function getJurnaltransaksi()
    {
        //return $this->hasOne(JurnalTransaksiBulan::className(),['AKUN_CODE'=>'AKUN_CODE','ACCESS_GROUP'=>'ACCESS_GROUP','BULAN'=>'MONTH_AT','TAHUN'=>'YEAR_AT']);
        return $this->hasOne(JurnalTransaksiBulan::className(),['AKUN_CODE'=>'AKUN_CODE','ACCESS_GROUP'=>'ACCESS_GROUP','BULAN'=>'MONTH_AT','TAHUN'=>'YEAR_AT']);
    }
    public function getJUMLAH(){
        $result=$this->jurnaltransaksi;
        $result = (empty($result->JUMLAH)) ? 0 : $result->JUMLAH;
        return $result;
    } 
	public function getDEBET(){
        $result=$this->jurnaltransaksi;
        $result = (empty($result->DEBET)) ? 0 : $result->DEBET;
        return $result;
    } 
	public function getKREDIT(){
        $result=$this->jurnaltransaksi;
        $result = (empty($result->KREDIT)) ? 0 : $result->KREDIT;
        return $result;
    }
	public function getTAHUN(){
        $result=$this->jurnaltransaksi;
        $result = (empty($result->TAHUN)) ? 0 : $result->TAHUN;
        return $result;
    }public function getBULAN(){
        $result=$this->jurnaltransaksi;
        $result = (empty($result->BULAN)) ? 0 : $result->BULAN;
        return $result;
    }
}
