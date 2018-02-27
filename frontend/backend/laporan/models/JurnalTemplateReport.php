<?php

namespace frontend\backend\laporan\models;

use Yii;

/**
 * This is the model class for table "jurnal_template_report".
 *
 * @property string $RPT_GROUP__ID
 * @property string $RPT_GROUP_NM
 * @property int $STATUS
 * @property string $KETERANGAN
 */
class JurnalTemplateReport extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jurnal_template_report';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['STATUS'], 'integer'],
            [['KETERANGAN'], 'string'],
            [['RPT_GROUP_NM'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'RPT_GROUP__ID' => 'Rpt  Group   ID',
            'RPT_GROUP_NM' => 'Rpt  Group  Nm',
            'STATUS' => 'Status',
            'KETERANGAN' => 'Keterangan',
        ];
    }
}
