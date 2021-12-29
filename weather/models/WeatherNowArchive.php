<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "weather_now_archive".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $name_user
 * @property string $created
 */
class WeatherNowArchive extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'weather_now_archive';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id',], 'integer'],
            [['name_user'], 'required'],
            [['created'], 'safe'],
            [['name_user'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'name_user' => 'Имя пользователя',
            'created' => 'Время создания',
        ];
    }

    public function getDataWeatherNowArchive(){
        return $this->hasMany(DataWeatherNowArchive::className(), ['data_id' => 'id']);
    }
}
