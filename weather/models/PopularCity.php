<?php

namespace app\models;

use Yii;
use app\models\DataWeatherNowArchive;
use yii\data\ArrayDataProvider;
use yii\data\ActiveDataProvider;
use yii2tech\csvgrid\CsvGrid;

class PopularCity 
{

    const CITIES = [
        'Санкт-Петербург'=> ['30.315644','59.938955'],
        'Москва'=>          ['37.622513','55.753231'],
        'Екатеринбург'=>    ['60.475066','56.788751'],
        'Пермь'=>           ['56.229425','58.022838'],
        'Уфа'=>             ['56.037733','54.730300'],
    ];

    public function getKnownCities(){

        foreach(self::CITIES as $city => $cord){

            $t = $this->getApi($cord[0],$cord[1]);

            $arhModel[] = [
                'city' => $city,
                'temp' => $t->temp,
                'temp_water' => $t->temp_water,
                'wind_speed' => $t->wind_speed,
                'wind_gust' => $t->wind_gust,
                'wind_dir' => $t->wind_dir,
            ];
        }

        return $arhModel;
    }

    public function exportKnownCities($id)
    {
        $query = DataWeatherNowArchive::find()->where('data_id = :id', [':id' => $id]);
        $exporter = new CsvGrid([
            'dataProvider' => new ActiveDataProvider([
                'query' => $query,
            ]),
        ]);
        return $exporter->export()->send('WeatherNowArchive.csv'); 
    }

    public function createKnownCities( $id ){

        foreach(self::CITIES as $city => $cord){

            $t = $this->getApi($cord[0],$cord[1]);

            $arh = new DataWeatherNowArchive;
            $arh->data_id = $id;

            $arh->city = $city;
            $arh->temp = $t->temp;
            $arh->temp_water = $t->temp;
            $arh->wind_speed = $t->wind_speed;
            $arh->wind_gust = $t->wind_gust;
            $arh->wind_dir = $t->wind_dir;
            $arh->save(false);
            
            $arhModel[] = [
                'city' => $city,
                'temp' => $t->temp,
                'temp_water' => $t->temp,
                'wind_speed' => $t->wind_speed,
                'wind_gust' => $t->wind_gust,
                'wind_dir' => $t->wind_dir,
            ];
        }

        $exporter = new CsvGrid([
            'dataProvider' => new ArrayDataProvider([
                'allModels' => $arhModel,
            ]),
            'columns' => [
                ['attribute' => 'city'],
                ['attribute' => 'temp'],
                ['attribute' => 'temp_water'],
                ['attribute' => 'wind_speed'],
                ['attribute' => 'wind_gust'],
                ['attribute' => 'wind_dir'],

            ],
        ]);
        return $exporter->export()->send('WeatherNowArchive.csv'); 
    }

    public function getApi( $cord_lat, $cord_lon ){
        $opts = [
            'http' => [
                'method' => "GET",
                'header' => "X-Yandex-API-Key:".Yii::$app->params['apiKey']."\r\n"
            ]
        ];

        $context = stream_context_create($opts);
        $f=file_get_contents("https://api.weather.yandex.ru/v2/forecast/?lat=$cord_lat&lon=$cord_lon&lang=ru_RU",false,$context);
        $f=json_decode($f);
        $t=$f->fact;
        return $t;
    }


}