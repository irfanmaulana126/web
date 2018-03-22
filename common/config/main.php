<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        // 'cache' => [
            // 'class' => 'yii\caching\FileCache',
        // ]
		'view' => [
			 'theme' => [
				 'pathMap' => [
					'@app/views' => '@frontend/views/layouts'
					//'@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
					//'@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/testing/app'
				 ],
			 ],
		],
		'assetManager' => [
			'bundles' => [
				'dmstr\web\AdminLteAsset' => [
					//'skin' => 'skin-black',
					//'skin' => "skin-blue",
					// 'skin' =>"skin-red",
					// 'skin' =>"skin-yellow",
					// 'skin' =>"skin-purple",
					// 'skin' =>"skin-green",
					// 'skin' =>"skin-blue-light",
					// 'skin' =>"skin-black-light",
					// 'skin' =>"skin-red-light",
					// 'skin' =>"skin-yellow-light",
					// 'skin' =>"skin-purple-light",
					// 'skin' =>'skin-green-light'
				],
			],
		],
    ],
];
