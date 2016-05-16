<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ReportesAvances */

$this->title = 'Update Reportes Avances: ' . ' ' . $model->RA_ID;
$this->params['breadcrumbs'][] = ['label' => 'Reportes Avances', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->RA_ID, 'url' => ['view', 'id' => $model->RA_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="reportes-avances-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
