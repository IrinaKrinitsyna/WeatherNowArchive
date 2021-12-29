<?php

use yii\db\Migration;

/**
 * Class m211229_122549_create_table_data_weather_now_archive
 */
class m211229_122549_create_table_data_weather_now_archive extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable('data_weather_now_archive', [
            'id' => $this->notNull(), 
            'data_id' => $this->string()->notNull(),
            'city' => $this->string()->notNull(),
            'temp' => $this->string()->notNull(),
            'temp_water' => $this->string()->notNull(),
            'wind_speed' => $this->string()->notNull(),
            'wind_gust' => $this->string()->notNull(),
            'wind_dir' => $this->string()->notNull(),
            'PRIMARY KEY (id)'
            ]);

        $this->createIndex('data_weather_now_archive_ibfk_1', 'data_weather_now_archive', 'data_id'); 
        $this->addForeignKey('data_weather_now_archive_ibfk_1', 'data_weather_now_archive', 'data_id', 'weather_now_archive', 'id');

          
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('data_weather_now_archive');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211229_122549_create_table_data_weather_now_archive cannot be reverted.\n";

        return false;
    }
    */
}
