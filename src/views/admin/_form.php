<?php
    /* @var $this yii\web\View */
    /* @var $model floor12\callback\models\Callback */
    /* @var $form yii\widgets\ActiveForm */

    use yii\helpers\Html;
    use yii\widgets\ActiveForm;

    $form = ActiveForm::begin([
    'id' => 'modal-form',
    'options' => ['class' => 'modaledit-form'],
    'enableClientValidation' => true
    ]);
    ?>

    <div class='modal-header'>
        <h2><?= $model->isNewRecord ? 'Создание' : 'Редактирование' ?>  объекта</h2>
    </div>

    <div class='modal-body'>

            <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    </div>

    <div class='modal-footer'>
        <?= Html::a('Отмена', '', ['class' => 'btn btn-default modaledit-disable']) ?> 
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?> 
    </div>

<?php ActiveForm::end(); ?>