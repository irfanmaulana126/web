<?php

namespace frontend\backend\dashboard\models;

use Yii;
use yii\base\Model;
use frontend\backend\dashboard\models\DayHourCount;
use frontend\backend\dashboard\models\Store;

class ChartDayHourSales extends Model
{
	 public $ACCESS_GROUP;
	 public $BULAN;
	 public $TAHUN;
	 public $TGL;
	 
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['BULAN','ACCESS_GROUP'], 'integer'],
            [['TAHUN'], 'string', 'max' => 5],
            [['TGL'], 'safe'],
        ];
    }   
	
	public function fields()
	{
		return [			
			'chart'=>function($model){
				return self::chartlabel($model->TAHUN,$model->BULAN,$model->TGL);
			},
			'categories'=>function(){
				return [
					self::categorieslabel()
				];
			},
			'dataset'=>function($model){
				return self::chartData($model->ACCESS_GROUP,$model->TAHUN,$model->BULAN,$model->TGL);				
			}
		];
	}
	
	private function chartData($accessGroup,$tahun,$bulan,$tgl){		
		//== PARAM TO CURRENT VARIABLE / DEFAULT VARIABLE
		// $accessGroup=Yii::$app->getUserOpt->user()['ACCESS_GROUP'];
		$varAccessGroup = $accessGroup!=''?$accessGroup:Yii::$app->getUserOpt->user()['ACCESS_GROUP'];//'170726220936';
		$varTahun		= $tahun!=''?$tahun:date('Y');
		$varBulan		= $bulan!=''?$bulan:date('m');
		$varTgl			= $tgl!=''?$tgl:date('Y-m-d');
		
		$datasetRslt=[];
		//=[0]== AMBIL STORE OF ACCESS_GROUP
		$modelStore=Store::find()->where(['ACCESS_GROUP'=>$varAccessGroup])->all();
	
		foreach($modelStore as $rowStore => $valStore){
			//=[1]== AMBIL DATA WEEKLY SALES
			$modelHour=DayHourCount::find()->where([
				'STORE_ID'=>$valStore['STORE_ID'],//'170726220936.0001',
				'TAHUN'=>$varTahun,
				'BULAN'=>$varBulan,
				'TGL'=>$varTgl
			])->all();
			
			//=[2]== AMBIL MINGGU AWAL BULAN
			$firstWeekOfMonth=$model= self::weekOfMonthMysql($varTahun.'-'.$varBulan.'-01');
			
			if ($modelHour){	
				foreach ($modelHour as $row => $val){
					$rslt1['seriesname']=$valStore['STORE_NM'];//$modelWeek[0]['STORE_NM'];
					$dataval1=[];
					//=[3]==LOOPING 24 hour
					for( $i= 1 ; $i <= 24 ; $i++ ) {
						$dataval1[]=['label'=>$i,'value'=>$val['VAL'.$i],'anchorBgColor'=>'#00fd83'];
					}
				
					//=[4]==SETTING ARRAY
					$rslt1['data']=$dataval1;	
					//$rsltDataSet1[]=$rslt1;
				}
				$dataset=$rslt1;//$rsltDataSet1;	
			}else{
				//=[6]== SCENARIO DATA KOSONG				
				$dataset=[
						"seriesname"=>$valStore['STORE_NM'],//"Tidak ditemukan data",
						"data"=>"null"					
				];
			}
			
			$datasetRslt[]=$dataset;
		}
		return $datasetRslt;		//jika data ada
	}
	
	private function chartlabel($tahun,$bulan,$tgl){
		$varTahun		= $tahun!=''?$tahun:date('Y');
		$varBulan		= $bulan!=''?$bulan:date('m');
		$varTgl			= $tgl!=''?$tgl:date('Y-m-d');
		$nmBulan=date('F', strtotime($varTahun.'-'.$varBulan.'-01')); // Nama Bulan
		$chart=[
			"caption"=> " HARIAN TRANSAKSI ",
			"subCaption"=>"Tanggal ".$varTgl,
			"captionFontSize"=> "12",
			"subcaptionFontSize"=> "10",
			"subcaptionFontBold"=> "0",
			"paletteColors"=> "#0B1234,#68acff,#00fd83,#e700c4,#8900ff,#fb0909,#0000ff,#ff4040,#7fff00,#ff7f24,#ff7256,#ffb90f,#006400,#030303,#ff69b4,#8b814c,#3f6b52,#744f4f,#6fae93,#858006,#426506,#055c5a,#a7630d,#4d8a9c,#449f9c,#8da9ab,#c4dfdd,#bf7793,#559e96,#afca84,#608e97,#806d88,#688b94,#b5dfe7,#b29cba,#83adb5,#c7bbc9,#2d5867,#e1e9b7,#bcd2d0,#f96161,#c9bbbb,#bfc5ce,#8f6d4d,#a87f99,#62909b,#a0acc0,#94b9b8",
			"bgcolor"=> "#ffffff",
			"showBorder"=> "0",
			"showShadow"=> "0",
			"usePlotGradientColor"=> "0",
			"legendBorderAlpha"=> "0",
			"legendShadow"=> "0",
			"showAxisLines"=> "1",
			"showAlternateHGridColor"=> "0",
			"divlineThickness"=> "1",
			"divLineIsDashed"=> "0",
			"divLineDashLen"=> "1",
			"divLineGapLen"=> "1",
			"vDivLineDashed"=> "0",
			"numVDivLines"=> "6",
			"vDivLineThickness"=> "1",
			"xAxisName"=> "24 Hour",
			"yAxisName"=> "Jumlah Transaction",
			"anchorradius"=> "3",
			"plotHighlightEffect"=> "fadeout|color=#f6f5fd, alpha=60",
			"showValues"=> "0",
			"rotateValues"=> "0",
			"placeValuesInside"=> "0",
			"formatNumberScale"=> "0",
			"decimalSeparator"=> ",",
			"thousandSeparator"=> ".",
			"numberPrefix"=> "",
			"ValuePadding"=> "0",
			"yAxisValuesStep"=> "1",
			"xAxisValuesStep"=> "0",
			"yAxisMinValue"=> "0",
			"numDivLines"=> "10",
			"xAxisNamePadding"=> "30",
			"showHoverEffect"=> "1",
			"animation"=> "1"			
		];
		return $chart;
	}
	
	private function categorieslabel(){
		$categories=[
			"category"=>[
				[
					"label"=> "01"
				],
				[
					"label"=> "02"
				],
				[
					"label"=> "03"
				],
				[
					"label"=> "04"
				],
				[
					"label"=> "05"
				],
				[
					"label"=> "06"
				],
				[
					"label"=> "07"
				],
				[
					"label"=> "08"
				],
				[
					"label"=> "09"
				],
				[
					"label"=> "10"
				],
				[
					"label"=> "11"
				],
				[
					"label"=> "12"
				],
				[
					"label"=> "13"
				],
				[
					"label"=> "14"
				],
				[
					"label"=> "15"
				],
				[
					"label"=> "16"
				],
				[
					"label"=> "17"
				],
				[
					"label"=> "18"
				],
				[
					"label"=> "19"
				],
				[
					"label"=> "20"
				],
				[
					"label"=> "21"
				],
				[
					"label"=> "22"
				],
				[
					"label"=> "23"
				],
				[
					"label"=> "24"
				]						
			]
		 ];
		 return $categories;
	}
	
	
	/*
	 * FUNCTION GET WEEK
	*/
	function weekOfMonthMysql($date) {
		$minggu= date('W', strtotime($date));
		if ($minggu<>0){
			return ($minggu)-1;
		} else{
			return $minggu;
		}
	}
}
