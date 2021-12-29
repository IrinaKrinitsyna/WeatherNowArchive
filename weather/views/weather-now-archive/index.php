<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use kartik\grid\GridView;
use yii\widgets\DetailView;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Архив погоды';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="weather-now-archive-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-sm-6">
            <div class="card" > <!-- style="width: 40rem;" -->
                <div class="card-body">
                    <h5 class="card-title">Температура сейчас</h5>
                    <?= GridView::widget([
                        'summary' => false,
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
                    <?= Html::a('Создать архив', ['weather-now-archive/add-archive'], ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Архивы</h5>
                        <?= GridView::widget([
                            'summary' => false,
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
                </div>
            </div>
        </div>
    </div>


</div>
