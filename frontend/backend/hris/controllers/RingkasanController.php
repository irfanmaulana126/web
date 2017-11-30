<?php

namespace frontend\backend\hris\controllers;

use yii\web\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class RingkasanController extends Controller
{
	//http://guzzle.readthedocs.io/en/latest/overview.html
    public function actionIndex()
    {
      	// 
		$client = new Client(['base_uri' => 'http://production.kontrolgampang.com/laporan/trans-rpt2s?TGL=2017-10-31']);
		//$request = new \GuzzleHttp\Psr7\Request('GET', 'TGL');
		print_r($client);
    }
}
