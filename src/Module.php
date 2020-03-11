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
    public $adminLayout = '@app/views/layouts/main';

    /**
     * @var string
     */
    public $viewForm = '@vendor/floor12/yii2-module-callback/src/views/frontend/_form';

    /**
     * @var string
     */
    public $viewResult = '@vendor/floor12/yii2-module-callback/src/views/frontend/_success';
    /**
     * @var string
     */
    public $viewAdminIndex = '@vendor/floor12/yii2-module-callback/src/views/backend/index';
    /**
     * @var string
     */
    public $userModel = 'app\models\User';
    /**
     * @var string
     */
    public $callbackModel = 'floor12\callback\models\Callback';
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'floor12\callback\controllers';

    /**
     * @var string
     */
    public $adminRoles = ['@'];

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
