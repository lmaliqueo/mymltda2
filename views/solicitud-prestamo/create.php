<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SolicitudPrestamo */

$this->title = 'Prestamo de Herramientas';
$this->params['breadcrumbs'][] = ['label' => 'Herramientas', 'url' => ['herramientas/index']];
$this->params['breadcrumbs'][] = ['label' => 'Solicitud Prestamos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="solicitud-prestamo-create">

<br>
    <?= $this->render('_form', [
        'model' => $model,
        'prestamo' => $prestamo,
        'cant_he' => $cant_he,
    ]) ?>

</div>
