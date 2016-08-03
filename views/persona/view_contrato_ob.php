<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Persona */

?>



<?php 
    Modal::begin([
            'header'=>'<h4>Sueldo</h4>',
            'id'=>'modal-sueldo',
            'size'=>'modal-sm',
        ]);
    echo "<div class='modalContentSu'></div>";
    Modal::end();
 ?>



<div class="persona-view">


<div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="no-margin">
            <?php echo $contrato->pERUT->PE_NOMBRES.' '.$contrato->pERUT->PE_APELLIDOPAT.' '.$contrato->pERUT->PE_APELLIDOMAT; ?>
        </h3>
    </div>
    <div class="box-body">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h4 class="box-title">Datos del Contrato</h4>
            </div>
            <div class="box-body no-padding">
                <table class="table table-striped table-bordered table-condensed">
                    <tr>
                        <th>RUT</th>
                        <td><?= $contrato->PE_RUT ?></td>
                    </tr>
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
</div>
        <div class="box-footer">
            <span class="pull-right">
                <?= Html::button('<i class="fa fa-edit"></i> Actualizar Sueldo', ['value'=>Url::to(['modificar-sueldo', 'id'=>$contrato->COO_ID]),'class' => 'btn btn-default text-blue btn-flat modalSueldo']) ?>
                <?= Html::a('<i class="fa fa-close"></i> Finalizar Contrato', ['delete', 'id' => $contrato->PE_RUT], [
                    'class' => 'btn btn-default text-red btn-flat',
                    'data' => [
                        'confirm' => '¿Está seguro de Finalizar este contrato?',
                        'method' => 'post',
                    ],
                ]) ?>
            </span>
        </div>
    </div>

</div>


<?php 
$script = <<< JS

    $('.modalSueldo').click(function() {
        $('#modal-sueldo').modal('show')
        .find('.modalContentSu')
        .load($(this).attr('value'));
    });
    
JS;
$this->registerJs($script);
?>
