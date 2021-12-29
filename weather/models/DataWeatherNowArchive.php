<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "data_weather_now_archive".
 *
 * @property int $id
 * @property int $data_id
 * @property string $city
 * @property int $temp
 * @property int $temp_water
 * @property int $wind_speed
 * @property int $wind_gust
 * @property string $wind_dir
 */
class DataWeatherNowArchive extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'data_weather_now_archive';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['temp', 'temp_water', 'wind_speed', 'wind_gust', 'wind_dir'], 'required'],
            [['data_id','temp', 'temp_water', 'wind_speed', 'wind_gust'], 'integer'],
            [['city'], 'string', 'max' => 128],
            [['wind_dir'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'city' => 'Город',
            'temp' => 'Температура воздуха',
            'temp_water' => 'Температура воды',
            'wind_speed' => 'Скорость ветра',
            'wind_gust' => 'Скорость порывов ветра',
            'wind_dir' => 'Направление ветра',
        ];
    }

    
}
