<?php

namespace floor12\callback\controllers;


use floor12\callback\models\Callback;
use floor12\callback\models\CallbackFilter;
use floor12\editmodal\DeleteAction;
use floor12\editmodal\IndexAction;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;


/**
 * AdminController implements the CRUD actions for Callback model.
 */
class AdminController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => Yii::$app->getModule('callback')->adminRoles,
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'index' => ['GET'],
//                    'form' => ['GET', 'POST'],
                    'delete' => ['DELETE'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'index' => [
                'class' => IndexAction::class,
                'model' => CallbackFilter::class,
            ],
//            'form' => [
//                'class' => EditModalAction::class,
//                'model' => Callback::class,
//                'message' => 'Объект сохранен'
//            ],
            'delete' => [
                'class' => DeleteAction::class,
                'model' => Callback::class,
                'message' => Yii::t('app.f12.callback', 'Request deleted')
            ],
        ];
    }


}
