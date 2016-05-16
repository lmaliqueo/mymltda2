<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SpreHeSolicita */

$this->title = 'Update Spre He Solicita: ' . ' ' . $model->SOLI_ID;
$this->params['breadcrumbs'][] = ['label' => 'Spre He Solicitas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->SOLI_ID, 'url' => ['view', 'id' => $model->SOLI_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="spre-he-solicita-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
