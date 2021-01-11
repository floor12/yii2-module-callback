<?php
/**
 * Created by PhpStorm.
 * User: floor12
 * Date: 2019-03-26
 * Time: 21:07
 *
 * @var $this \yii\web\View
 */

use yii\helpers\Html;


echo Html::tag('div', Yii::t('app.f12.callback', 'Thank you'), ['class' => 'f12-callback-modal-title']);
echo Html::tag('p', Yii::t('app.f12.callback', 'We will contact you soon. This window will be closed in 5 sec.'));
echo Html::tag('button', Yii::t('app.f12.callback', 'Close now'), [
    'class' => 'btn btn-primary ',
    'onclick' => 'f12Callback.close(); return false;'
]);
echo Html::tag('script', 'f12Callback.autoclose();');