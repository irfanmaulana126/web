<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */


namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class MapAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

    ];
    public $js = [
		'https://maps.googleapis.com/maps/api/js?key=AIzaSyB_BOmcuyR1X9XuFy314bhI1KX9IKfoGQA&libraries=places',
	];
 // public $jsOptions = ['position' => \yii\web\View::POS_BEGIN];

    public $depends = [
      //   'yii\web\YiiAsset',
      //  'yii\bootstrap\BootstrapAsset',
    ];


}
