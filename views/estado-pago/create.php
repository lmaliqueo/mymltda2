<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EstadoPago */

$this->title = 'Crear Estado de Pago';
$this->params['breadcrumbs'][] = ['label' => 'Ordenes de Trabajos', 'url' => ['orden-trabajo/index']];
$this->params['breadcrumbs'][] = [
                    'label' => $ordentrabajo->OT_NOMBRE,
                    //'url' => ['orden-trabajo/index'],
                    'style'=> 'color:white',
                    'template' => "<button class='btn btn-flat btn-sm' style='background-color : #333D43; color:white; float:right; margin-left: 4px;'>{link}</button>\n"
                ];
$this->params['breadcrumbs'][] = ['label' => 'Estado de Pago', 'url' => ['orden-trabajo/index-estado-pago', 'id'=>$ordentrabajo->OT_ID]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estado-pago-create">


    <?= $this->render('_form', [
        'model' => $model,
        'arreglo' => $arreglo,
        'asignados' => $asignados,
        'actividades' => $actividades,
        'ordentrabajo' => $ordentrabajo,
    ]) ?>

</div>
