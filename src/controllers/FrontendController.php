<?php
/**
 * Created by PhpStorm.
 * User: floor12
 * Date: 2019-03-26
 * Time: 12:49
 */

namespace floor12\callback\controllers;


use floor12\callback\models\Callback;
use Yii;
use yii\web\Controller;

class FrontendController extends Controller
{
    public $defaultAction = 'form';

    protected $callbackModule;

    public function init()
    {
        $this->callbackModule = Yii::$app->getModule('callback');
        parent::init();
    }

    public function actionForm($topic_id = null)
    {
        $className = $this->callbackModule->callbackModel;
        /** @var $model Callback */
        $model = new $className;
        if ($topic_id !== null) {
            $model->topic_id = (int)$topic_id;
        }
        if (
            Yii::$app->request->isPost &&
            Yii::createObject($this->callbackModule->creatorClass, [$model, Yii::$app->request->post()])->execute()
        )
            return $this->renderAjax($this->callbackModule->viewResult);

        return $this->renderAjax($this->callbackModule->viewForm, ['model' => $model]);
    }
}
