<?php

namespace floor12\callback;

use floor12\callback\models\CallbackTopics;
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
    public $viewAdminIndex = '@vendor/floor12/yii2-module-callback/src/views/admin/index';
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
    public $creatorClass = 'floor12\callback\logic\CallbackCreate';
    /**
     * @var string
     */
    public $topicsClass = 'floor12\callback\models\CallbackTopics';

    /**
     * @var string
     */
    public $adminRoles = ['@'];
    /**
     * @var CallbackTopics
     */
    public $topics;

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->registerTranslations();
        $this->topics = Yii::createObject($this->topicsClass, []);
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

    public function listTopicSubjects()
    {
        return $this->topics::$subjects;
    }

    public function getTopicEmails($topicId)
    {
        return $this->topics->getTopicEmails($topicId);
    }

    public function getTopicSubject($topicId)
    {
        return $this->topics->getTopicSubject($topicId);
    }
}
