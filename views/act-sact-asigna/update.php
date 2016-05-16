<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ActSactAsigna */

$this->title = 'Update Act Sact Asigna: ' . ' ' . $model->AS_ID;
$this->params['breadcrumbs'][] = ['label' => 'Act Sact Asignas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->AS_ID, 'url' => ['view', 'id' => $model->AS_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="act-sact-asigna-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
