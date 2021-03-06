<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Weather Now Archives';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="weather-now-archive-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Weather Now Archive', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'name_user',
            'data_id',
            'created',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
