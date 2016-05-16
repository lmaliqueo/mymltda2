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
            <h3 class="box-title"><?= $model->AC_NOMBRE ?></h3>
            <div class="box-tools">
                <span class="badge bg-blue no-margin"><h5 class="no-margin"><strong><?= $model->AC_ESTADO ?></strong></h5></span>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-5">
                    <p class="text-center text-blue"><strong>Sub-Actividades</strong></p>
                        <?php foreach ($subact as $asignado) {
                        $promedio= ($asignado->AS_CANTIDADACTUAL*100)/$asignado->AS_CANTIDAD; ?>
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
                                <?php /*
                        <div class="row">
                            <div class="col-md-8">
                            </div>
                            <div class="col-md-4">
                                    <?php if($asignado->AS_CANTIDADACTUAL!=$asignado->AS_CANTIDAD){ ?>
                                       <h5 class="description-header text-blue"><b>$ <?= $asignado->AS_COSTOACTUAL ?></b>/<?= $asignado->AS_COSTOTOTAL ?></h5>
                                    <?php }else{ ?>
                                       <h5 class="description-header text-green"><b>$ <?= $asignado->AS_COSTOACTUAL ?></b>/<?= $asignado->AS_COSTOTOTAL ?></h5>
                                    <?php } ?>
                            </div>
                        </div>*/ ?>
                        <?php } ?>
                </div>
                <div class="col-md-5">
                            <table class="table">
                                <thead>
                                    <tr class="bg-green">
                                        <th>Rut</th>
                                        <th>Nombres</th>
                                        <th>Tipo de Obrero</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>

                                    </tr>
                                </tbody>    
                            </table>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <?= Html::button('<span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Asignar Actividad', ['value'=>Url::to(['persona/asignar','pro'=>$model->AC_ID]),'class'=> 'btn btn-success','id'=>'asignarbutton']) ?>
        </div>
    </div>


        <div class="panel panel-primary">
          <div class="panel-heading"><span class="glyphicon glyphicon glyphicon-pushpin" aria-hidden="true"></span> <strong>Actividad: </strong><?= Html::encode($model->AC_NOMBRE) ?></div>

       <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'AC_ID',
                'OT_ID',
                'AC_FECHA_INICIO',
                'AC_FECHA_TERMINO',
                'AC_COSTO_TOTAL',
                'AC_ESTADO',
            ],
        ]) ?>

    <?php if($model->AC_ESTADO!='Finalizado'){ ?> 
    <div class="panel-footer clearfix">
        <div class="pull-right">

    

             <div class="btn-group" role="group" aria-label="...">
                    <?= Html::a('<span class="glyphicon glyphicon glyphicon-pencil" aria-hidden="true"></span> Actualizar', ['update', 'id' => $model->AC_ID], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('<span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span> Eliminar', ['delete', 'id' => $model->AC_ID], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Esta seguro de borrar esta Actividad',
                            'method' => 'post',
                        ],
                    ]) ?>
            </div>
       </div>
    </div>
        <?php } ?>


        </div>









    <?php if($model->AC_ESTADO!='Finalizado' && $subact==NULL){ ?> 
        <?= Html::a('<span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Asignar Sub-Actividad', ['act-sact-asigna/create', 'id' => $model->AC_ID], ['class' => 'btn btn-success']) ?>
        <?php } ?>
 <?php if($subact!=NULL){ ?>  


<?php /*
<div class="row">
<div class="col-md-7">
    <div class="box box-success">
        <div class="box-header with-border">
            <h4 class="box-title">Subactividades</h4>
            <div class="box-tools pull-right">
                <?= Html::a('<span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span>', ['act-sact-asigna/create', 'id' => $model->AC_ID], ['class' => 'btn btn-success btn-sm']) ?>
            </div>
        </div>
        <div class="box-body">

                <?php foreach ($subact as $asignado) {
                $promedio= ($asignado->AS_CANTIDADACTUAL*100)/$asignado->AS_CANTIDAD; ?>
            <div class="col-md-8">
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
            <div class="col-md-4">
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
</div>
*/ ?>


<?php /*
        <table class="table table-condensed">
            <tr>
                <th>Nombre</th>
                <th>Progreso</th>
                <th>Cantidad</th>
                <th>Costo</th>
            </tr>
            <?php foreach ($subact as $asignado) {
            $promedio= ($asignado->AS_CANTIDADACTUAL*100)/$asignado->AS_CANTIDAD; ?>
            <tr>
                <td><?= $asignado->sACT->SACT_NOMBRE ?></td>
                <td>
                    <div class="progress progress-xs">
                        <?php if ($asignado->AS_CANTIDADACTUAL==$asignado->AS_CANTIDAD) { ?>
                            <div class="progress-bar progress-bar-success" style="width:<?php echo $promedio; ?>%"></div>                        
                        <?php }else{ ?>
                            <div class="progress-bar progress-bar-primary" style="width:<?php echo $promedio; ?>%"></div>
                        <?php } ?>
                    </div>
                </td>
                <td><strong><?= $asignado->AS_CANTIDADACTUAL ?></strong>/<?= $asignado->AS_CANTIDAD ?></td>
                <td><strong>$ <?= $asignado->AS_COSTOACTUAL ?></strong>/<?= $asignado->AS_COSTOTOTAL ?></td>
            </tr>       
            <?php } ?>
        </table>











<div class="panel panel-info">
          <div class="panel-heading"><span class="glyphicon glyphicon glyphicon-tags" aria-hidden="true"></span> <strong>Subactividades Asignados</strong></div>

            <table class="table table-bordered">
        <tr class="active">
            <th>Subactividad</th>
            <th>Cantidad</th>
            <th>Costo por Subactividad</th>
            <th></th>
       </tr>
        <?php foreach ($subact as $key): ?>
        <tr>
                        <td><?= $key->sACT->SACT_NOMBRE ?></td>
                        <td><?= $key->AS_CANTIDAD ?></td>
                        <td><?= $key->AS_COSTOTOTAL ?></td>
                        <td><?= Html::a('<span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>', ['act-sact-asigna/delete', 'id' => $key->AS_ID], [
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]);?></td>
       </tr>
        <?php endforeach ?>


       </table>




    </div>
*/ ?>

    <?php } ?>
</div>