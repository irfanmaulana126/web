<?php
namespace console\controllers;

use Yii;
use yii\base\DynamicModel;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Request;
use yii\helpers\Json;
use yii\data\ArrayDataProvider;
use yii\console\Controller;			
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

class ChartSummaryController extends Controller
{
    public function behaviors()
    {
        return [
			'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ]
        ];
    }

	
	public function actionMonthOfYear(){

		Yii::$app->db->createCommand("
			call ChartSummaryMonthOfYear('170726220936','2017');
		")->execute();
	}
	
	
	
}
?>