<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class LocateAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
      'js/locate.js',
      'js/geoPosition.js',      
    ];
    public $depends = [
    ];
}
