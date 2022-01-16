<?php

namespace floor12\callback\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * CallbackFilter represents the model behind the search form of `floor12\callback\models\Callback`.
 */
class CallbackFilter extends Model

{
    public $filter;
    public $topic_id;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['filter', 'string'],
            ['topic_id', 'integer'],
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
        $className = Yii::$app->getModule('callback')->callbackModel;
        $query = $className::find()
            ->andFilterWhere(['=', 'topic_id', $this->topic_id])
            ->andFilterWhere(['OR', ['LIKE', 'name', $this->filter], ['LIKE', 'phone', $this->filter]]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
        ]);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        return $dataProvider;
    }

    public function listTopicSubjects()
    {
        return Yii::$app->getModule('callback')->listTopicSubjects();
    }
}
