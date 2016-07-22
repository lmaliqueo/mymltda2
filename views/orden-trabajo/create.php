<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OrdenTrabajo */

$this->title = 'Crear Orden de Trabajo';
$this->params['breadcrumbs'][] = ['label' => 'Orden Trabajos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orden-trabajo-create">

    <?= $this->render('_form', [
        'model' => $model,
        'proyectos' => $proyectos,
    ]) ?>

</div>
