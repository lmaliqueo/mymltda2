<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SolicitudPrestamo */

$this->title = 'Update Solicitud Prestamo: ' . ' ' . $model->SPRE_ID;
$this->params['breadcrumbs'][] = ['label' => 'Solicitud Prestamos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->SPRE_ID, 'url' => ['view', 'id' => $model->SPRE_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="solicitud-prestamo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
