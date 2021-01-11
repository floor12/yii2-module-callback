<?php

namespace floor12\callback\models;

/**
 * This is the ActiveQuery class for [[Callback]].
 *
 * @see Callback
 */
class CallbackQuery extends \yii\db\ActiveQuery
{

    /**
     * {@inheritdoc}
     * @return Callback[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Callback|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
