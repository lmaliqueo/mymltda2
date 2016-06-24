<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;


/* @var $this yii\web\View */
?>

<?php 
        Modal::begin([
                'header'=>'<h4>Sueldo</h4>',
                'id'=>'Sueldo',
                'size'=>'modal-tn',
            ]);
        echo "<div class='modalContent'></div>";
        Modal::end();
 ?>

<div class="col-md-5">

    <?php if($contrato!=NULL){ ?>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h4 class="box-title">Contrato</h4>
        </div>
        <div class="box-body no-padding">
            <table class="table table-hover table-bordered table-condensed">
                <tr>
                    <th>Proyecto</th>
                    <td><?= $contrato->pRO->PRO_NOMBRE ?></td>
                </tr>
                <tr>
                    <th>Tipo de Obrero</th>
                    <td><?= $contrato->tOB->TOB_NOMBRE ?></td>
                </tr>
                <tr>
                    <th>Fecha de Contrato</th>
                    <td><?= $contrato->COO_FECHA ?></td>
                </tr>
                <tr>
                    <th>Estado de Contrato</th>
                    <td><?= $contrato->COO_ESTADO ?></td>
                </tr>
                <tr>
                    <th>Sueldo</th>
                    <?php if ($sueldo!=NULL) { ?>
                        <td>$<?= $sueldo->SU_CANTIDAD ?></td>
                    <?php }else{ ?>
                        <td><span class="not-set">sin sueldo</span></td>
                    <?php } ?>
                </tr>
            </table>
        </div>
    </div>
    <?php } ?>
</div>


<div class="col-md-5">


    <div class="box box-success">
        <div class="box-header with-border">
            <h4 class="box-title">Actividades</h4>
        </div>
        <div class="box-body no-padding">
            <?php if ($actividades!=NULL) { ?>
                <table class="table table-hover table-bordered table-condensed">
                    <tr class="active">
                        <th>Actividad</th>
                        <th>Fecha de Inicio</th>
                        <th>Fecha Termino</th>
                        <th>Estado</th>
                    </tr>
                    <tbody>
                    <?php foreach ($actividades as $key): ?>
                    <tr>
                        <td><?= $key->AC_NOMBRE ?></td>
                        <td><?= $key->AC_FECHA_INICIO ?></td>
                        <td><?= $key->AC_FECHA_TERMINO ?></td>
                        <td><?php if ($key->AC_ESTADO=='En proceso') { ?>
                                <span class="badge bg-blue"><?= $key->AC_ESTADO ?></span></td>
                            <?php }elseif($key->AC_ESTADO=='Finalizado'){ ?>
                                <span class="badge bg-green"><?= $key->AC_ESTADO ?></span></td>
                            <?php }elseif($key->AC_ESTADO=='Pendiente'){ ?>
                                <span class="badge"><?= $key->AC_ESTADO ?></span></td>
                            <?php } ?>

                    </tr>
                    <?php endforeach ?>

                    </tbody>
                </table>
            <?php }else{ ?>
                <div class="text-center bg-gray-light">No se han asignado actividades para este obrero</div>
            <?php } ?>
        </div>
        <div class="box-footer">
            <div class="pull-right">
                 <div class="btn-group" role="group" aria-label="...">
                    <?php if($contrato->COO_ESTADO!='Finalizado'){ ?>
                        <?= Html::a('Asignar actividad', ['asignar-act', 'id' => $model->PE_RUT,'proyecto'=> $contrato->PRO_ID], ['class' => 'btn btn-success']) ?>
                    <?php } ?>
                    <?php if ($actividades!=NULL) { ?>
                        <?= Html::a('Ver Calendario de actividades', ['actividades/calendario'], ['class' => 'btn btn-primary']) ?>
                    <?php } ?>

                </div>

           </div>
        </div>
    </div>


</div>

<div class="col-md-2">
    <div class="btn-group-vertical">
        <?php if($contrato->COO_ESTADO!='Finalizado'){ ?>
            <?= Html::a('Asignar actividad', ['asignar-act', 'id' => $model->PE_RUT,'proyecto'=> $contrato->PRO_ID], ['class' => 'btn btn-success']) ?>
            <?= Html::button('Modificar sueldo', ['value'=>Url::to(['persona/modificar-sueldo', 'id'=>$contrato->COO_ID]),'class'=> 'btn btn-primary','id'=>'modalSueldo']) ?>
            <?= Html::a('Finalizar contrato', ['asignar-act', 'id' => $model->PE_RUT,'proyecto'=> $contrato->PRO_ID], ['class' => 'btn btn-danger']) ?>
        <?php } elseif($contrato->COO_ESTADO=='Finalizado' or $contrato==NULL){ ?>
            <?= Html::a('Crear nuevo contrato', ['asignar-act', 'id' => $model->PE_RUT,'proyecto'=> $contrato->PRO_ID], ['class' => 'btn btn-primary']) ?>
        <?php } ?>
    </div>
</div>




<?php 
$script = <<< JS

    $('#otID').change(function(){
        var ot = $(this).val();
        var rut= $(this).attr('perut');
            $.get('index.php?r=persona/get-calendario',{ rut : rut, ot : ot }, function(data){
                $('.contenidoact').empty();
                $('.contenidoact').append(data);
            })

    });
$(function() {

       $('#modalSueldo').click(function() {
         $('#Sueldo').modal('show')
         .find('.modalContent')
         .load($(this).attr('value'));
       });
});

JS;
$this->registerJs($script);
?>
