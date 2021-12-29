<?php

use yii\db\Migration;

/**
 * Class m211229_121233_create_table_weather_now_archive
 */
class m211229_121233_create_table_weather_now_archive extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('weather_now_archive', [
            'id' => $this->notNull(), 
            'user_id' => $this->string()->notNull(),
            'name_user' => $this->string()->notNull(),
            'created' => $this->dateTime()->notNull(),
            'PRIMARY KEY (id)'
            ]);

        $this->createIndex('weather_now_archive_ibfk_1', 'weather_now_archive', 'user_id'); 
        $this->addForeignKey('weather_now_archive_ibfk_1', 'weather_now_archive', 'user_id', 'user', 'id');
        

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('weather_now_archive');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211229_121233_create_table_weather_now_archive cannot be reverted.\n";

        return false;
    }
    */
}
