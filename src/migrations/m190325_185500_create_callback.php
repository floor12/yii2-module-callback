<?php

use yii\db\Migration;

/**
 * Class m190325_185500_create_callback
 */
class m190325_185500_create_callback extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%callback}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull()->comment('Time'),
            'name' => $this->string()->notNull()->comment('Name'),
            'phone' => $this->string(14)->notNull()->comment('Phone number')
        ], $tableOptions);

        $this->createIndex('idx-callback-created_at', '{{%callback}}', 'created_at');
        $this->createIndex('idx-callback-name', '{{%callback}}', 'name');
        $this->createIndex('idx-callback-phone', '{{%callback}}', 'phone');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%callback}}');
    }


}
