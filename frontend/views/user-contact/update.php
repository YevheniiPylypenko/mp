<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\UserContact */

$this->title = Yii::t('frontend', 'Update {modelClass}', [
    'modelClass' => 'Contact',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'User Contacts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Update ').$model->info];

?>
<div class="user-contact-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
