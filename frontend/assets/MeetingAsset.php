<?php
namespace frontend\assets;
use yii\web\AssetBundle;

class MeetingAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
      'css/bootstrap-combobox.css',
    ];
    public $js = [
      'js/meeting.js',
      'js/jstz.min.js',
      'js/bootstrap-combobox.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
