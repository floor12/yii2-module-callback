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
use yii\helpers\Html;
use yii\web\Controller;

class FrontendController extends Controller
{
    public $defaultAction = 'form';

    public function actionForm()
    {
        $model = new Callback();

        if (
            Yii::$app->request->isPost &&
            Yii::createObject(CallbackCreate::class, [$model, Yii::$app->request->post()])->execute()
        )
            return $this->renderAjax('_success');



        return $this->renderAjax('_form', ['model' => $model]);
    }
}