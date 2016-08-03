<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\Actividades */

$this->title = $model->AC_NOMBRE;
$this->params['breadcrumbs'][] = ['label' => 'Actividades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="actividades-view">



    <div class="page-header">
        <h3 class="">
            <?= $model->AC_NOMBRE ?>
        </h3>
    </div>
        <div class="box box-primary">
            <div class="box-body">

                       <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                'AC_ID',
                                //'oT.OT_NOMBRE',
                                'AC_FECHA_INICIO:date',
                                'AC_FECHA_TERMINO:date',
                                'AC_COSTO_TOTAL',
                                'AC_ESTADO',
                            ],
                        ]) ?>
            </div>
        </div>
<br>
        <div class="page-header">
            <h3 class="box-title">
                Subactividades
                <span class="pull-right">
                    <?= Html::a('<i class="fa fa-edit"></i> Asignar Sub-actividades', ['act-sact-asigna/create', 'id' => $model->AC_ID], ['class' => 'btn btn-flat bg-light-blue', 'style'=>'border-with:1px; border-color:#3C8DBC;']) ?>
                </span>
            </h3>
        </div>
        <div class="box box-primary">
            <div class="box-body">

                <table class="table table-bordered">
                    <tr class="bg-light-blue">
                        <th>Sub-actividad</th>
                        <th>Progreso</th>
                        <th>%</th>
                        <th>Contratada</th>
                        <th>Actual</th>
                        <th>Costo Actual</th>
                    </tr>
                    <?php foreach ($subact as $asignado) {
                    $promedio= ($asignado->AS_CANTIDADACTUAL*100)/$asignado->AS_CANTIDAD; ?>
                        <tr>    
                            <td><?= $asignado->sACT->SACT_NOMBRE ?></td>
                            <td><div class="progress progress-xs"><div class="progress-bar progress-bar-primary" style="width: <?php echo $promedio; ?>%"></div></div></td>
                            <td><span class="badge bg-light-blue"><?php echo $promedio; ?>%</span> </td>
                            <td><?= $asignado->AS_CANTIDAD ?></td>
                            <td><?= $asignado->AS_CANTIDADACTUAL ?></td>
                            <td>$ <?= $asignado->AS_COSTOACTUAL ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>








        <div class="box box-solid">
            <?php if($obreros!=NULL){ ?>
                <table class="table">
                    <tr class="bg-blue">
                        <th>RUT</th>
                        <th>Nombres</th>
                        <th>Tipo de Obrero</th>
                        <th>Sueldo</th>
                    </tr>
                    <tr>
                        <?php foreach ($obreros as $obrero) { ?>
                            <td><?= $obrero->PE_RUT ?></td>
                            <td><?= $obrero->pERUT->PE_NOMBRES.$obrero->pERUT->PE_APELLIDOPAT.$obrero->pERUT->PE_APELLIDOMAT?></td>
                            <td><?= $obrero->tOB->NOMBRE ?></td>
                            <?php foreach ($sueldos as $sueldo) {
                                if($sueldo->COO_ID == $obrero->COO_ID){ ?>
                                    <td><?= $sueldo->SU_CANTIDAD ?></td>
                            <?php break;
                                }} ?>
                        <?php } ?>
                    </tr>
                </table>
            <?php } ?>
        </div>

    
                    <?php // Html::a('Asignar Obrero', ['asignar-obreros', 'id' => $model->AC_ID], ['class' => 'btn btn-flat btn-warning']) ?>
</div>