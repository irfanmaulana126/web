<?php
use yii\helpers\Html;
use kartik\dropdown\DropdownX;

echo Html::beginTag('div', ['class'=>'pull-right dropdown','style'=>'position: relative;z-index: 10000;']);
echo Html::button('Ringkasan Laporan <span class="caret"></span></button>', 
	['type'=>'button', 'class'=>'btn btn-default', 'data-toggle'=>'dropdown']);
echo DropdownX::widget([
	'items' => [
		['label' => 'Laporan Arus Uang', 'url' => '/laporan/arus-uang'],
		['label' => 'Laporan Penjualan', 'url' => '/laporan/sales'],
		//'<li class="divider"></li>',
		['label' => 'Laporan PPOB', 'url' => '/laporan/ppob'],
		//'<li class="divider"></li>',
		['label' => 'Laporan Donasi', 'url' => '#'],
	],
]); 
echo Html::endTag('div');


?>