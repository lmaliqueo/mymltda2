<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\Proyecto */

$this->title = $model->PRO_NOMBRE;
$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proyecto-view">



<?php 
    Modal::begin([
            'header'=>'<h4>Asignar Encargado de Construcción</h4>',
            'id'=>'modal',
            'size'=>'modal-tn',
        ]);
    echo "<div class='modalContent'></div>";
    Modal::end();
 ?>

<?php 
    Modal::begin([
            'header'=>'<h4>Proyecto</h4>',
            'id'=>'modal-view',
            'size'=>'modal-tn',
        ]);
    echo "<div class='modalContent'></div>";
    Modal::end();
 ?>

<br>





<div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="no-margin">
            <?= $model->PRO_NOMBRE ?>
            <span class="pull-right">
                <?= Html::button('<i class="fa fa-pencil"></i> Modificar', ['value'=>Url::to(['proyecto/update','id' => $model->PRO_ID]), 'class' => 'btn bg-light-blue btn-block btn-flat modalView']) ?>
            </span>
        </h3>
    </div>
    <div class="box-body">
        <div class="box box-primary">
            <div class="box-body">
                <div id="contenido">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'PRO_ID',
                            'cOM.COM_NOMBRE',
                            'eMPRUT.EMP_NOMBRE',
                            //'PRO_COSTO_TOTAL',
                            'PRO_FECHA_INICIO',
                            //'PRO_FECHA_FINAL',
                            'PRO_ESTADO',
                            'PRO_DIRECCION',
                        ],
                    ]) ?>
                </div>
            </div>
            <?php /*
            <div class="box-footer">
                <?= Html::a('Generar Informe',['generar-info', 'id'=>$model->PRO_ID],['class'=>'btn btn-flat btn-primary']) ?>
            </div>*/ ?>
        </div>
    </div>
</div>

<div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="no-margin">
            Encargados de Construcción Asignados
            <span class="pull-right">
                <?= Html::button('<i class="fa fa-edit"></i> Asignar Encargado', ['value'=>Url::to(['proyecto/asignar-encargado','id' => $model->PRO_ID]), 'class' => 'btn bg-light-blue btn-block btn-flat','id'=>'modalButton']) ?>
            </span>
        </h3>
    </div>
    <div class="box-body">

        <div class="box box-primary">
            <div class="box-body">
                <table class="table table-bordered table-striped">
                    <tr class="bg-light-blue">
                        <th>Rut</th>
                        <th>Nombre</th>
                        <th>Cargo</th>
                        <th>Teléfono</th>
                    </tr>
                    <?php foreach ($encargados as $asignados) { ?>
                        <tr>
                            <td><?= $asignados->uS->PE_RUT ?></td>
                            <td><?= $asignados->uS->pERUT->PE_NOMBRES ?></td>
                            <td><?= $asignados->uS->pERUT->cA->CA_NOMBRE ?></td>
                            <td><?= $asignados->uS->pERUT->PE_TELEFONO ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>

    </div>
</div>




</div>

<?php 
$script = <<< JS

$(function(){
    $(document).on('click', '.view', function(e) {
        $(this).addClass('active');
    });

});



    
JS;
$this->registerJs($script);
?>

