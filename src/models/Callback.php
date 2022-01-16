<?php

namespace floor12\callback\models;

use floor12\phone\PhoneValidator;
use Yii;

/**
 * This is the model class for table "callback".
 *
 * @property int $id
 * @property int $created_at Time
 * @property string $name Name
 * @property string $phone Phone number
 * @property integer $topic_id Topic ID
 * @property string $topic Topic name
 */
class Callback extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'callback';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'name', 'phone', 'topic_id'], 'required'],
            [['created_at', 'topic_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['phone'], PhoneValidator::class],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => Yii::t('app.f12.callback', 'Time'),
            'name' => Yii::t('app.f12.callback', 'Name'),
            'phone' => Yii::t('app.f12.callback', 'Phone number'),
            'topic_id' => Yii::t('app.f12.callback', 'Topic'),
            'topic' => Yii::t('app.f12.callback', 'Topic'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return CallbackQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CallbackQuery(get_called_class());
    }

    public function getTopic()
    {
        return Yii::$app->getModule('callback')->getTopicSubject($this->topic_id);
    }
}
