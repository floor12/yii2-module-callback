<?php

use yii\db\Migration;

/**
 * Class m220115_233142_add_type_id
 */
class m220115_233142_add_type_id extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('callback', 'topic_id', $this->integer()->null());
        $this->createIndex('callback-topic_id', 'callback', 'topic_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('callback', 'topic_id');
    }

}
