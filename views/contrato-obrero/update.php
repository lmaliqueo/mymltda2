<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ContratoObrero */

$this->title = 'Update Contrato Obrero: ' . ' ' . $model->COO_ID;
$this->params['breadcrumbs'][] = ['label' => 'Contrato Obreros', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->COO_ID, 'url' => ['view', 'id' => $model->COO_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="contrato-obrero-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
