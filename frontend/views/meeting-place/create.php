<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\MeetingPlace */

$this->title = Yii::t('frontend', 'Add a Place');
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Meetings'), 'url' => ['/meeting']];
$this->params['breadcrumbs'][] = ['label'=>$title,'url' => ['/meeting/view', 'id' => $model->meeting_id]];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="meeting-place-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    <?= $this->registerJs("$(document).ready(function(){ $('.combobox').combobox() });"); ?>

</div>
<?php
  $gpJsLink= 'https://maps.googleapis.com/maps/api/js?' . http_build_query(array(
                          'libraries' => 'places',
                          'key' => Yii::$app->params['google_maps_key'],
                  ));
  echo $this->registerJsFile($gpJsLink);

  $options = '{"componentRestrictions":{"country":"us"}}';
  // turned off "types":["establishment"]
  echo $this->registerJs("(function(){
        var input = document.getElementById('meetingplace-searchbox');
        var options = $options;
        searchbox = new google.maps.places.Autocomplete(input, options);
        setupListeners('meetingplace');
})();" , \yii\web\View::POS_END );
// 'setupBounds('.$bound_bl.','.$bound_tr.');
?>
