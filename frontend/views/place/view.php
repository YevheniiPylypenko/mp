<?php

use dosamigos\google\maps\Map;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\Marker;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Place */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Places'), 'url' => ['/user-place']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>

<div class="col-md-6">
<div class="place-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            //'place_type',
            ['label' => Yii::t('frontend','Website'),
     'value' => Html::a($model->website, $model->website),
     'format' => 'raw'],
            'full_address',
        ],
    ]) ?>
    <p>
      <?= Html::a(Yii::t('frontend', 'Edit'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
      <?= Html::a(Yii::t('frontend', 'Return to Places'), ['/user-place'], ['class' => 'btn btn-primary']) ?>
             <?php /* Html::a(Yii::t('frontend', 'Delete'), ['delete', 'id' => $model->id], [
                 'class' => 'btn btn-danger',
                 'data' => [
                     'confirm' => Yii::t('frontend', 'Are you sure you want to delete this item?'),
                     'method' => 'post',
                 ],
             ]) */ ?>
    </p>

</div>
</div> <!-- end first col -->
<div class="col-md-6">
  <?php
  if ($gps!==false) {
    $coord = new LatLng(['lat' => $gps->lat, 'lng' => $gps->lng]);
    $map = new Map([
        'center' => $coord,
        'zoom' => 14,
        'width'=>300,
        'height'=>300,
    ]);
    $marker = new Marker([
        'position' => $coord,
        'title' => $model->name,
    ]);
    // Add marker to the map
    $map->addOverlay($marker);
    echo $map->display();
  } else {
    echo 'No location coordinates for this place could be found.';
  }
  ?>

</div> <!-- end second col -->
