<?php
/**
 * Created by PhpStorm.
 * User: floor12
 * Date: 19.06.2018
 * Time: 18:07
 */

namespace floor12\callback\assets;

use yii\web\AssetBundle;

class CallbackFrontendAsset extends AssetBundle
{
    public $sourcePath = '@vendor/floor12/yii2-module-callback/src/assets';

    public $css = [
        'f12.callback.css',
    ];

    public $js = [
        'f12.callback.js',
    ];
}
