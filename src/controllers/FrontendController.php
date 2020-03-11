<?php
/**
 * Created by PhpStorm.
 * User: floor12
 * Date: 2019-03-26
 * Time: 12:49
 */

namespace floor12\callback\controllers;


use floor12\callback\logic\CallbackCreate;
use floor12\callback\models\Callback;
use Yii;
use yii\web\Controller;

class FrontendController extends Controller
{
    public $defaultAction = 'form';

    public function actionForm()
    {
        $className = Yii::$app->getModule('callback')->callbackModel;
        $model = new $className;
        if (
            Yii::$app->request->isPost &&
            Yii::createObject(CallbackCreate::class, [$model, Yii::$app->request->post()])->execute()
        )
            return $this->renderAjax(Yii::$app->getModule('callback')->viewResult);

        return $this->renderAjax(Yii::$app->getModule('callback')->viewForm, ['model' => $model]);
    }
}
