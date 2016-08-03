<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \kartik\typeahead\TypeaheadBasic;
use common\components\MiscHelpers;
/* @var $this yii\web\View */
/* @var $model frontend\models\Meeting */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="meeting-form">
    <?php $form = ActiveForm::begin(); ?>
    <?php /* echo $form->field($model, 'meeting_type')
            ->dropDownList(
                $model->getMeetingTypeOptions(),
                ['prompt'=>Yii::t('frontend','What type of meeting is this?')]
            )->label(Yii::t('frontend','Meeting Type'))
            */
            ?>
        <div class="row">
          <div class="col-md-6">
    <?php
    echo $form->field($model, 'subject')->widget(TypeaheadBasic::classname(), [
    'data' => $subjects,
    'options' => ['placeholder' => Yii::t('frontend','what\'s the subject of this meeting?'),
    'id'=>'meeting-subject',
      //'class'=>'input-large form-control'
    ],
    'pluginOptions' => ['highlight'=>true],
]);
?>
  </div>
</div>
    <?php // $form->field($model, 'subject')->textInput(['maxlength' => 255])->label(Yii::t('frontend','Subject')) ?>
    <div class="itemHide">
    <?= $form->field($model, 'message')->textarea(['rows' => 6])->label(Yii::t('frontend','Message'))->hint(Yii::t('frontend','Optional')) ?>
    </div>
    <div class="form-group">
      <span class="button-pad">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('frontend', 'Submit') : Yii::t('frontend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
      </span><span class="button-pad">
        <?= Html::a(Yii::t('frontend','Cancel'), ['/meeting/view', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
      </span>
    </div>
    <?php ActiveForm::end();
     $this->registerJsFile(MiscHelpers::buildUrl().'/js/meeting_subject.js',['depends' => [\yii\web\JqueryAsset::className()]]);
     ?>
</div>
