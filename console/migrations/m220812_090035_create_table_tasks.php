<?php

use yii\db\Migration;

/**
 * Class m220812_090035_create_table_tasks
 */
class m220812_090035_create_table_tasks extends Migration
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

        $this->createTable('{{%tasks}}', [
            'id' => $this->primaryKey(),
            'description' => $this->string(256)->notNull()->unique(),
            'status_id' => $this->integer()->notNull(),
            'priority' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-tasks-status_id',
            '{{%tasks}}',
            'status_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-tasks-status_id',
            '{{%tasks}}',
            'status_id',
            '{{%statuses}}',
            'id',
            'CASCADE'
        );

        $this->insert('{{%tasks}}', [
            'description' => 'Make some noise',
            'status_id' => 1,
            'priority' => 3,
            'created_at' => date ("Y-m-d H:i:s")
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-tasks-status_id',
            '{{%tasks}}'
        );

        $this->dropIndex(
            'idx-tasks-status_id',
            '{{%tasks}}'
        );

        $this->dropTable('{{%tasks}}');
        return false;
    }


    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220812_090035_create_table_tasks cannot be reverted.\n";

        return false;
    }
    */
}
