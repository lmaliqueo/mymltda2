<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ActSactAsigna */

$this->title = $actividad->AC_NOMBRE;
$this->params['breadcrumbs'][] = ['label' => $actividad->oT->OT_NOMBRE, 'url' => ['actividades/calendario', 'id'=>$actividad->OT_ID]];
$this->params['breadcrumbs'][] = ['label' => 'Actividades', 'url' => ['actividades/calendario', 'id'=>$actividad->OT_ID]];
$this->params['breadcrumbs'][] = ['label' => $actividad->AC_NOMBRE, 'url' => ['actividades/view', 'id'=>$actividad->AC_ID]];
$this->params['breadcrumbs'][] = 'Asignar Sub-actividades';
?>
<div class="act-sact-asigna-create">


    <?= $this->render('_form', [
        'model' => $model,
                'asignados' => $asignados,
                 'actividad' => $actividad,
                 'subactividades' => $subactividades,
    ]) ?>

</div>
