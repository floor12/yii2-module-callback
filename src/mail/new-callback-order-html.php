<?php
/**
 * Created by PhpStorm.
 * User: floor12
 * Date: 08.08.2018
 * Time: 22:21
 *
 * @var $this \yii\web\View
 * @var $model \floor12\callback\models\Callback
 */

?>

<h1><?= Yii::t('app.f12.callback', 'New callback request from website:') ?></h1>

<ul>
    <li><b><?= $model->attributeLabels()['name'] ?></b>: <?= $model->name ?></li>
    <li><b><?= $model->attributeLabels()['phone'] ?></b>: <?= \floor12\phone\PhoneFormatter::run($model->phone) ?></li>
</ul>

