<?php

use yii\db\Migration;

/**
 * Class m220812_085232_create_table_statuses
 */
class m220812_085232_create_table_statuses extends Migration
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

        $this->createTable('{{%statuses}}', [
            'id' => $this->primaryKey(),
            'description' => $this->string(256)->notNull()->unique(),
        ], $tableOptions);

        Yii::$app->db->createCommand()->batchInsert('{{%statuses}}', ['description'], [
            ['Created'],
            ['In Progress'],
            ['Finished']
        ])->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->truncateTable('{{%statuses}}');
        $this->dropTable('{{%statuses}}');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220812_085232_create_table_statuses cannot be reverted.\n";

        return false;
    }
    */
}
