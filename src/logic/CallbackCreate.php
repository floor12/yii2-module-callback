<?php
/**
 * Created by PhpStorm.
 * User: floor12
 * Date: 2019-03-26
 * Time: 18:37
 */

namespace floor12\callback\logic;

use floor12\callback\models\Callback;
use Yii;
use yii\base\InvalidConfigException;

class CallbackCreate
{
    /**
     * @var Callback
     */
    protected $model;
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
    function __construct(Callback $model, array $data)
    {
        if (empty(Yii::$app->params['no-replyEmail']))
            throw new InvalidConfigException('Parametr `no-replyEmail` not found in app config.');

        if (empty(Yii::$app->params['no-replyName']))
            throw new InvalidConfigException('Parametr `no-replyName` not found in app config.');

        if (empty(Yii::$app->params['callbackEmail']))
            throw new InvalidConfigException('Parametr `callbackEmail` not found in app config.');

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

        $this->model->on(Callback::EVENT_AFTER_INSERT, function ($event) {
            Yii::$app
                ->mailer
                ->compose(
                    ['html' => "@vendor/floor12/yii2-module-callback/src/mail/new-callback-order-html.php"],
                    ['model' => $this->model]
                )
                ->setFrom([Yii::$app->params['no-replyEmail'] => Yii::$app->params['no-replyName']])
                ->setSubject(Yii::t('app.f12.callback', 'New callback request'))
                ->setTo(Yii::$app->params['callbackEmail'])
                ->send();
        });

        return $this->model->save();
    }
}