<?php
/**
 * Created by PhpStorm.
 * User: floor12
 * Date: 2019-03-26
 * Time: 18:37
 */

namespace floor12\callback\logic;

use floor12\callback\models\Callback;
use floor12\callback\Module;
use Yii;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;
use yii\db\ActiveRecordInterface;

class CallbackCreate
{
    /**
     * @var Callback
     */
    protected $model;
    /**
     * @var Module
     */
    protected $module;
    /**
     * @var array
     */
    protected $data = [];

    /**
     * CallbackCreate constructor.
     * @param Callback $model
     * @param array $data
     * @throws InvalidConfigException
     */
    function __construct(ActiveRecordInterface $model, array $data)
    {
        if (empty(Yii::$app->params['no-replyEmail']))
            throw new InvalidConfigException('Parametr `no-replyEmail` not found in app config.');

        if (empty(Yii::$app->params['no-replyName']))
            throw new InvalidConfigException('Parametr `no-replyName` not found in app config.');

        $this->module = Yii::$app->getModule('callback');
        $this->data = $data;
        $this->model = $model;
        $this->model->created_at = time();
    }

    /**
     * @return bool
     */
    public function execute()
    {
        $this->model->load($this->data);

        $this->model->on(ActiveRecord::EVENT_AFTER_INSERT, function ($event) {
            Yii::$app
                ->mailer
                ->compose(
                    ['html' => "@vendor/floor12/yii2-module-callback/src/mail/new-callback-order-html.php"],
                    ['model' => $this->model]
                )
                ->setFrom([Yii::$app->params['no-replyEmail'] => Yii::$app->params['no-replyName']])
                ->setSubject($this->module->getTopicSubject($this->model->topic_id))
                ->setTo($this->module->getTopicEmails($this->model->topic_id))
                ->send();
        });

        return $this->model->save();
    }
}
