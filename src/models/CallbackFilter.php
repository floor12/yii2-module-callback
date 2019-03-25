<?php

namespace floor12\callback\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * CallbackFilter represents the model behind the search form of `floor12\callback\models\Callback`.
 */
class CallbackFilter extends Model

{
    public $filter;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['filter', 'string'],
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function dataProvider()
    {
        $query = Callback::find()
            ->andFilterWhere(['OR', ['LIKE', 'name', $this->filter], ['LIKE', 'phone', $this->filter]]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        return $dataProvider;
    }
}
