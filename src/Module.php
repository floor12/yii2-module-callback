<?php

namespace floor12\callback;

use Yii;
/**
 * Callback module definition class
 * @property  string $editRole
 */
class Module extends \yii\base\Module
{
    /**
     * @var string
     */
    public $adminlayout = '@app/views/layouts/main';

    /**
     * @var string
     */
    public $viewForm= '@vendor/floor12/yii2-module-callback/src/views/frontend/_form';

    /**
     * @var string
     */
    public $viewResult= '@vendor/floor12/yii2-module-callback/src/views/frontend/_result';

    /**
     * @var string
     */
    public $userModel = 'app\models\User';
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'floor12\callback\controllers';

    /**
     * @var string
     */
    public $editRole = '@';

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->registerTranslations();
    }


    /**
     *
     */
    public function registerTranslations()
    {
        Yii::$app->i18n->translations['app.f12.callback'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => '@vendor/floor12/yii2-module-callback/src/messages',
            'sourceLanguage' => 'en-US',
            'fileMap' => [
                'app.f12.callback' => 'callback.php',
            ],
        ];
    }

}