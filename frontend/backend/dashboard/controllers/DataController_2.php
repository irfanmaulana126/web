<?php

namespace frontend\backend\dashboard\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\filters\ContentNegotiator;
use yii\web\Response;

/**
 * FoodtownController implements the CRUD actions for Foodtown model.
 */
class DataController extends Controller
{
	public function behaviors(){
        return ArrayHelper::merge(parent::behaviors(), [
			'bootstrap'=> [
				'class' => ContentNegotiator::className(),
				'formats' => [
					'application/json' => Response::FORMAT_JSON,'charset' => 'UTF-8',
				],
				'languages' => [
					'en',
					'de',
				],
			],
			'corsFilter' => [
				'class' => \yii\filters\Cors::className(),
				'cors' => [
					// restrict access to
					//'Origin' => ['http://lukisongroup.com','http://www.lukisongroup.com','http://labtest1-erp.int'],
					'Origin' => ['*'],
					'Access-Control-Request-Method' => ['POST', 'PUT','GET'],
					// Allow only POST and PUT methods
					'Access-Control-Request-Headers' => ['X-Wsse'],
					// Allow only headers 'X-Wsse'
					'Access-Control-Allow-Credentials' => true,
					// Allow OPTIONS caching
					'Access-Control-Max-Age' => 3600,
					// Allow the X-Pagination-Current-Page header to be exposed to the browser.
					'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page'],
				]		
			],
        ]);	
	} 	  
    
    
    public function actionDailyTransaksi()
    {
       $data1='
			{
				"chart": {
					"caption": " HARIAN TRANSAKSI ",
					"subCaption": "Tanggal",
					"captionFontSize": "12",
					"subcaptionFontSize": "10",
					"subcaptionFontBold": "0",
					"paletteColors": "#0B1234,#68acff,#00fd83,#e700c4,#8900ff,#fb0909,#0000ff,#ff4040,#7fff00,#ff7f24,#ff7256,#ffb90f,#006400,#030303,#ff69b4,#8b814c,#3f6b52,#744f4f,#6fae93,#858006,#426506,#055c5a,#a7630d,#4d8a9c,#449f9c,#8da9ab,#c4dfdd,#bf7793,#559e96,#afca84,#608e97,#806d88,#688b94,#b5dfe7,#b29cba,#83adb5,#c7bbc9,#2d5867,#e1e9b7,#bcd2d0,#f96161,#c9bbbb,#bfc5ce,#8f6d4d,#a87f99,#62909b,#a0acc0,#94b9b8",
					"bgcolor": "#ffffff",
					"showBorder": "0",
					"showShadow": "0",
					"usePlotGradientColor": "0",
					"legendBorderAlpha": "0",
					"legendShadow": "0",
					"showAxisLines": "1",
					"showAlternateHGridColor": "0",
					"divlineThickness": "1",
					"divLineIsDashed": "0",
					"divLineDashLen": "1",
					"divLineGapLen": "1",
					"vDivLineDashed": "0",
					"numVDivLines": "6",
					"vDivLineThickness": "1",
					"xAxisName": "Hour",
					"yAxisName": "Jumlah Transaction",
					"anchorradius": "3",
					"plotHighlightEffect": "fadeout|color=#f6f5fd, alpha=60",
					"showValues": "0",
					"rotateValues": "0",
					"placeValuesInside": "0",
					"formatNumberScale": "0",
					"decimalSeparator": ",",
					"thousandSeparator": ".",
					"numberPrefix": "",
					"ValuePadding": "0",
					"yAxisValuesStep": "1",
					"xAxisValuesStep": "0",
					"yAxisMaxvalue": "200",
					"yAxisMinValue": "0",
					"numDivLines": "10",
					"xAxisNamePadding": "30",
					"showHoverEffect": "1",
					"animation": "1"
				},
				"categories": [
					{
						"category": [
							{
								"label": "06"
							},
							{
								"label": "07"
							},
							{
								"label": "08"
							},
							{
								"label": "09"
							},
							{
								"label": "10"
							},
							{
								"label": "11"
							},
							{
								"label": "12"
							},
							{
								"label": "13"
							},
							{
								"label": "14"
							},
							{
								"label": "15"
							},
							{
								"label": "16"
							},
							{
								"label": "17"
							},
							{
								"label": "18"
							},
							{
								"label": "19"
							},
							{
								"label": "20"
							},
							{
								"label": "21"
							},
							{
								"label": "22"
							},
							{
								"label": "23"
							},
							{
								"label": "24"
							},
							{
								"label": "01"
							},
							{
								"label": "02"
							},
							{
								"label": "03"
							},
							{
								"label": "04"
							},
							{
								"label": "05"
							}
						]
					}
				],
				"dataset": [
					{
						"seriesname": "TOKO A",
						"data": null
					},
					{
						"seriesname": "TOKO B",
						"data": [
							{
								"label": "10",
								"value": "54",
								"anchorBgColor": "#68acff"
							},
							{
								"label": "11",
								"value": "46",
								"anchorBgColor": "#68acff"
							},
							{
								"label": "12",
								"value": "160",
								"anchorBgColor": "#68acff"
							},
							{
								"label": "13",
								"value": "139",
								"anchorBgColor": "#68acff"
							},
							{
								"label": "14",
								"value": "127",
								"anchorBgColor": "#68acff"
							},
							{
								"label": "15",
								"value": "118",
								"anchorBgColor": "#68acff"
							},
							{
								"label": "16",
								"value": "84",
								"anchorBgColor": "#68acff"
							},
							{
								"label": "17",
								"value": "116",
								"anchorBgColor": "#68acff"
							},
							{
								"label": "18",
								"value": "139",
								"anchorBgColor": "#68acff"
							},
							{
								"label": "19",
								"value": "123",
								"anchorBgColor": "#68acff"
							},
							{
								"label": "20",
								"value": "53",
								"anchorBgColor": "#68acff"
							},
							{
								"label": "21",
								"value": "21",
								"anchorBgColor": "#68acff"
							}
						]
					},
					{
						"seriesname": "TOKO C",
						"data": [
							{
								"label": "10",
								"value": "15",
								"anchorBgColor": "#00fd83"
							},
							{
								"label": "11",
								"value": "59",
								"anchorBgColor": "#00fd83"
							},
							{
								"label": "12",
								"value": "100",
								"anchorBgColor": "#00fd83"
							},
							{
								"label": "13",
								"value": "82",
								"anchorBgColor": "#00fd83"
							},
							{
								"label": "14",
								"value": "79",
								"anchorBgColor": "#00fd83"
							},
							{
								"label": "15",
								"value": "54",
								"anchorBgColor": "#00fd83"
							},
							{
								"label": "16",
								"value": "55",
								"anchorBgColor": "#00fd83"
							},
							{
								"label": "17",
								"value": "111",
								"anchorBgColor": "#00fd83"
							},
							{
								"label": "18",
								"value": "168",
								"anchorBgColor": "#00fd83"
							},
							{
								"label": "19",
								"value": "139",
								"anchorBgColor": "#00fd83"
							},
							{
								"label": "20",
								"value": "120",
								"anchorBgColor": "#00fd83"
							},
							{
								"label": "21",
								"value": "27",
								"anchorBgColor": "#00fd83"
							}
						]
					}
				]
			}  
	   ';
	   return json::decode($data1);
    }
	
	public function actionMonthySales(){
		/* $_distributorStockGudang= new ArrayDataProvider([
			'allModels'=>Yii::$app->db_esm->createCommand("	
					SELECT x2.TGL,month(x2.TGL) AS bulan,DATE_FORMAT(x2.TGL,'%d') as TGL_NO,LEFT(COMPONEN_hari(x2.TGL),2) as hari, 
						x2.KD_BARANG ,x4.NM_BARANG,x2.SO_QTY #, 
						#TRUNCATE(SUM(CASE WHEN  x2.SO_TYPE=1 AND x2.SO_QTY>=0 THEN (x2.SO_QTY / x2.UNIT_QTY) ELSE 0 END),2) as STCK_GUDANG
						,sum(CASE WHEN  x2.SO_TYPE=3 AND x2.SO_QTY>=0 THEN (x2.SO_QTY/ 24) ELSE 0 END) as TOTAL_PO
					FROM so_t2 x2 
					LEFT JOIN b0001 x4 on x4.KD_BARANG=x2.KD_BARANG
					WHERE x2.SO_TYPE=3 #AND (x2.TGL) IN ('2017-01-21','2016-03-20','2016-08-31','2016-10-22','2016-11-19','2016-12-24')

					GROUP BY MONTH(x2.TGL) #x2.TGL
					ORDER BY x2.TGL
			")->queryAll(), 
			'pagination' => [
					'pageSize' => 200,
			],				 
		]);
		$_modelDistributorStockGudang=ArrayHelper::toArray($_distributorStockGudang->getModels());		
		$lineColor = ArrayHelper::toArray(Yii::$app->arrayBantuan->ArrayRowPaletteColors());
		foreach($_modelDistributorStockGudang as $row => $value){			
			$dateValue = strtotime($value['TGL']);
			$yr = date("Y", $dateValue);
			$mon = date("m", $dateValue); 
			$date = date("d", $dateValue); 
			if ($yr=='2016'){
				$distStockGudangChip2016[]=["Bln"=>$mon,"value"=>str_replace('.',',',$value['TOTAL_PO']),"Thn"=>$yr,"anchorBgColor"=> $lineColor[0]];
			};
			if ($yr=='2017'){
				$distStockGudangChip2017[]=["Bln"=>$mon,"value"=>str_replace('.',',',$value['TOTAL_PO']),"Thn"=>$yr,"anchorBgColor"=> $lineColor[1]];
			};
								
		};
		
		//STOCK GUDANG - TAHUN 2016
		$keybulan2016 = array_column($distStockGudangChip2016, 'Bln');
		$bulan    = array('1','2','3','4','5','6','7','8','9','10','11','12');
		foreach($bulan as $bul)
		{
			if(!in_array($bul,$keybulan2016))
			{
				$aryStockGudangChip2016[] = array('Bln'=>$bul,'value'=>'',"anchorBgColor"=> $lineColor[0]);
			}
		}
		$aryStokGudangDist2016 = ArrayHelper::merge($distStockGudangChip2016,$aryStockGudangChip2016);
		$rsltStokGudangDist2016=Yii::$app->arrayBantuan->sort_multi_array($aryStokGudangDist2016,'Bln'); 
		//return $rsltStokGudangDist2016;
		
		//STOCK GUDANG - TAHUN 2017
		$keybulan2017 = array_column($distStockGudangChip2017, 'Bln');
		foreach($bulan as $bul)
		{
			if(!in_array($bul,$keybulan2017))
			{
				$aryStockGudangChip2017[] = array('Bln'=>$bul,'value'=>'',"anchorBgColor"=> $lineColor[1]);
			}
		}
		$aryStokGudangDist2017 = ArrayHelper::merge($distStockGudangChip2017,$aryStockGudangChip2017);
		$rsltStokGudangDist2017=Yii::$app->arrayBantuan->sort_multi_array($aryStokGudangDist2017,'Bln');  */
		//return $rsltStokGudangDist2016;
		
		/**
		 * Maping Chart 
		 * Type : msline
		 * 
		*/
		$rsltSrc='{
			"chart": {
				"caption": "RINGKASAN PENJUALAN BULANAN",
				"subCaption": "Tahun 2017/2018",
				"captionFontSize": "12",
				"subcaptionFontSize": "10",
				"subcaptionFontBold": "0",
				"paletteColors": '.'"'.Yii::$app->arrayBantuan->ArrayPaletteColors().'"'.',
				"bgcolor": "#ffffff",
				"showBorder": "0",
				"showShadow": "0",				
				"usePlotGradientColor": "0",
				"legendBorderAlpha": "0",
				"legendShadow": "0",
				"showAxisLines": "1",
				"showAlternateHGridColor": "0",
				"divlineThickness": "1",
				"divLineIsDashed": "0",				
				"divLineDashLen": "1",				
				"divLineGapLen": "1",
				"vDivLineDashed": "0",
				"numVDivLines": "11",
				"vDivLineThickness": "1",
				"xAxisName": "Toko",
				"yAxisName": "Rupiah",				
				"anchorradius": "6",
				"plotHighlightEffect": "fadeout|color=#f6f5fd, alpha=60",
				"showValues": "0",
				"rotateValues": "0",
				"placeValuesInside": "0",
				"formatNumberScale": "0",
				"decimalSeparator": ",",
				"thousandSeparator": ".",
				"numberPrefix": "",
				"ValuePadding": "0",
				"yAxisValuesStep":"1",
				"xAxisValuesStep":"0",
				"yAxisMaxvalue": "2500",
				"yAxisMinValue": "0",
				"numDivLines": "8",
				"xAxisNamePadding": "30",
				"showHoverEffect":"1",
				"animation": "1" ,
				"exportEnabled": "1",
				"exportFileName":"SALES-PO",
				"exportAtClientSide":"1",
				"showValues":"1"				
			},
			"categories": [
				{
					"category": [
						{
							"label": "january"
						},
						{
							"label": "February"
						},
						{
							"label": "March"
						},
						{
							"label": "April"
						},
						{
							"label": "Mey"
						},
						{
							"label": "June"
						},
						{
							"label": "July"
						},
						{
							"label": "Agustus"
						},
						{
							"label": "September"
						},
						{
							"label": "Oktober"
						},
						{
							"label": "November"
						},
						{
							"label": "Desember"
						}						
					]
				}
			],
			"dataset": [
				{
					"seriesname": "PO-CIP-2016",
					"data":[{"value":100},{"value":1000}]
				},
				{
					"seriesname": "PO-CIP-2017",
					"data":[{"value":100}]
				}
			]			
				
		}'; 
		
		return json::decode($rsltSrc);
		//return $_distributorStockGudang;
	}
}
