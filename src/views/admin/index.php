<?php


use floor12\callback\assets\CallbackAdminAsset;
use floor12\callback\models\Callback;
use floor12\editmodal\EditModalHelper;
use floor12\phone\PhoneFormatter;
use kartik\form\ActiveForm;
use yii\grid\GridView;
use yii\widgets\Pjax;

CallbackAdminAsset::register($this);

$this->title = Yii::t('app.f12.callback', 'Callback requests');
$this->params['breadcrumbs'][] = $this->title;

?>

    <h1><?= $this->title ?></h1>

<?php $form = ActiveForm::begin([
    'method' => 'GET',
    'options' => ['class' => 'autosubmit', 'data-container' => '#items'],
    'enableClientValidation' => false,
]); ?>

    <div class="filter-block">
        <?= $form->field($model, 'filter')
            ->label(false)
            ->textInput([
                'placeholder' => Yii::t('app.f12.callback', 'Search'),
                'autofocus' => true
            ]);
        ?>
    </div>

<?php

ActiveForm::end();

Pjax::begin([
    'id' => 'items',
    'scrollTo' => true,
]);

echo GridView::widget([
    'dataProvider' => $model->dataProvider(),
    'layout' => '{items}{pager}{summary}',
    'tableOptions' => ['class' => 'table table-striped'],
    'columns' => [
        'id',
        'created_at:datetime',
        'name',
        [
            'attribute' => 'phone',
            'content' => function (Callback $model) {
                return PhoneFormatter::run($model->phone);
            }
        ],
        [
            'contentOptions' => ['style' => 'text-align:right;'],
            'content' => function (Callback $model) {
                return EditModalHelper::deleteBtn(['delete'], $model->id);
            }
        ],
    ],
]);

Pjax::end();