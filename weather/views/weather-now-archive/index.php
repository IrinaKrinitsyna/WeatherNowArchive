<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Weather Now Archives';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="weather-now-archive-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать архив', ['weather-now-archive/add-archive'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProviderCities,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label'=>'Город',
                'value' => function ($data) {
                    return $data['city'];
                },
            ],
            [
                'label'=>'Температура',
                'value' => function ($data) {
                    return $data['temp'];
                },
            ]
        ]
    ]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'user_id',
            'name_user',
            // 'data_id',
            'created',
            // ['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{export}',
                'buttons' => [
                    'export' => function ($url,$model,$key) {
                        return Html::a('Скачать', $url);
                    },
                ],
            ],
        ],
    ]); ?>


</div>
