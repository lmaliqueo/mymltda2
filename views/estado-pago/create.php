<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EstadoPago */

$this->title = 'Crear Estado de Pago';
$this->params['breadcrumbs'][] = ['label' => 'Estado de Pago', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estado-pago-create">

    <h1>Nuevo Estado de Pago</h1>

    <?= $this->render('_form', [
        'model' => $model,
        'arreglo' => $arreglo,
        'asignados' => $asignados,
        'actividades' => $actividades,
        'proyecto' => $proyecto,
    ]) ?>

</div>
