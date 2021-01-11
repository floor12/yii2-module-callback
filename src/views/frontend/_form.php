<?php
/**
 * Created by PhpStorm.
 * User: floor12
 * Date: 2019-03-26
 * Time: 12:56
 *
 * @var $this \yii\web\View
 * @var $model \floor12\callback\models\Callback
 */

use yii\helpers\Html;
use yii\web\JqueryAsset;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

JqueryAsset::register($this);

$form = ActiveForm::begin([
    'id' => 'callback-form',
    'options' => ['onsubmit' => 'f12Callback.submit(); return false;'],
    'enableClientValidation' => false
]);

echo Html::tag('div', Yii::t('app.f12.callback', 'Callback request'), ['class' => 'f12-callback-modal-title']);

echo Html::tag('p', Yii::t('app.f12.callback', 'Fill your name and phone number and we will callback you as soon as possible.'));

echo $form->field($model, 'name')->textInput(['maxlength' => true, 'autofocus' => true]);

echo $form->field($model, 'phone')
    ->widget(MaskedInput::className(), ['mask' => '+9 (999) 999-99-99']);

echo Html::button(Yii::t('app.f12.callback', 'Close'), [
    'class' => 'btn btn-default ',
    'onclick' => 'f12Callback.close(); return false;'
]);

echo Html::submitButton(Yii::t('app.f12.callback', 'Send'), ['class' => 'btn btn-primary']);

ActiveForm::end();
