<?php

namespace floor12\callback\models;

use Yii;

/**
 * This is the model class for table "callback".
 *
 * @property int $id
 * @property int $created_at Time
 * @property string $name Name
 * @property string $phone Phone number
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
            [['created_at', 'name', 'phone'], 'required'],
            [['created_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 14],
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
}
