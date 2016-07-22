<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SolicitudPrestamo */

$this->title = 'Prestamo de Herramientas';
$this->params['breadcrumbs'][] = ['label' => 'Solicitud Prestamos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="solicitud-prestamo-create">

    <h1>Crear Solicitud</h1>
<br>
    <?= $this->render('_form', [
        'model' => $model,
        'prestamo' => $prestamo,
        'cant_he' => $cant_he,
    ]) ?>

</div>
