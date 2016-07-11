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


    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title text-blue"><strong><?= $model->AC_NOMBRE ?></strong></h3>
            <div class="box-tools">
                <span class="badge bg-blue no-margin"><h5 class="no-margin"><strong><?= $model->AC_ESTADO ?></strong></h5></span>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                   <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'AC_ID',
                            //'oT.OT_NOMBRE',
                            'AC_FECHA_INICIO:date',
                            'AC_FECHA_TERMINO:date',
                            'AC_COSTO_TOTAL',
                        ],
                    ]) ?>
                </div>
                <div class="col-md-8">
                            <h4 class="box-title text-center"><strong>Subactividades</strong></h4>

                            <?php foreach ($subact as $asignado) {
                            $promedio= ($asignado->AS_CANTIDADACTUAL*100)/$asignado->AS_CANTIDAD; ?>
                                <div class="col-md-9">
                                    <div class="progress-group">
                                            <span class="progress-text"><?= $asignado->sACT->SACT_NOMBRE ?></span>
                                            <span class="progress-number"><b><?= $asignado->AS_CANTIDADACTUAL ?></b>/<?= $asignado->AS_CANTIDAD ?></span>
                                            <div class="progress sm">
                                                <?php if ($asignado->AS_CANTIDADACTUAL==$asignado->AS_CANTIDAD) { ?>
                                                    <div class="progress-bar progress-bar-success" style="width:<?php echo $promedio; ?>%"></div>                        
                                                <?php }else{ ?>
                                                    <div class="progress-bar progress-bar-primary" style="width:<?php echo $promedio; ?>%"></div>
                                                <?php } ?>            
                                            </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <?php if($asignado->AS_CANTIDADACTUAL!=$asignado->AS_CANTIDAD){ ?>
                                       <h4 class="text-blue"><b>$ <?= $asignado->AS_COSTOACTUAL ?></b>/<?= $asignado->AS_COSTOTOTAL ?></h4>
                                    <?php }else{ ?>
                                       <h4 class="text-green"><b>$ <?= $asignado->AS_COSTOACTUAL ?></b>/<?= $asignado->AS_COSTOTOTAL ?></h4>
                                    <?php } ?>
                                </div>

                            <?php } ?>

                </div>
            </div>  
        </div>
        <div class="box-footer">
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
    </div>

    
                    <?= Html::a('Asignar Sub-actividades', ['act-sact-asigna/create', 'id' => $model->AC_ID], ['class' => 'btn btn-flat btn-primary']) ?>
                    <?= Html::a('Asignar Obrero', ['asignar-obreros', 'id' => $model->AC_ID], ['class' => 'btn btn-flat btn-warning']) ?>
</div>