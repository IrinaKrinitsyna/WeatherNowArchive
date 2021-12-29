<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\WeatherNowArchive */

$this->title = 'Create Weather Now Archive';
$this->params['breadcrumbs'][] = ['label' => 'Weather Now Archives', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="weather-now-archive-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
