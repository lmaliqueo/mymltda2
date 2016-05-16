<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\EstadoPago */

$this->title = $model->EP_ID;
$this->params['breadcrumbs'][] = ['label' => 'Estado Pagos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estado-pago-view">


<?php 
    Modal::begin([
            'header'=>'<h4>Asignar Cantidad Utilizado</h4>',
            'id'=>'modal',
            'size'=>'modal-lg',
        ]);
    echo "<div class='modalContent'></div>";
    Modal::end();
 ?>



    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::button('<span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Generear EP', ['value'=>Url::to(['generar-ep','id' => $model->EP_ID]),'class'=> 'btn btn-flat btn-success','id'=>'modalButton']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->EP_ID], ['class' => 'btn btn-flat btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->EP_ID], [
            'class' => 'btn btn-flat btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'EP_ID',
            'EP_NUMEROEP',
            'EP_FECHA',
            'EP_PERIODO',
            'EP_TOTALEP',
            'EP_FACTURA',
        ],
    ]) ?>








<div class="box">
    <div class="box-header">
        <h4 class="box-title">Estado de Pago N° <?= $model->EP_NUMEROEP ?></h4>
    </div>
    <div class="box-body">
        <table class="table table-condensed">
            <thead>
            <tr class="bg-light-blue">
                <th>Items</th>
                <th>Cantidad Contratada</th>
                <th>Precio Unitario Contratado</th>
                <th>Precio Total Contratado</th>
                <th>Cantidad a la Fecha</th>
                <th>Costo a la Fecha</th>
                <th>Cantidad Anterior</th>
                <th>EP Anterior</th>
                <th>Cantidad EP actual</th>
                <th>EP actual</th>
            </tr></thead>


        <?php 
        foreach ($ep_asig as $asignado){ ?>
            <tr class="active">
                <th><?= $asignado->aS->aC->AC_NOMBRE ?></td>
                <td colspan="9"></td>
            </tr>
            <tbody class="table table-bordered">
                <tr>
                    <td><ul><li><?= $asignado->aS->sACT->SACT_NOMBRE ?></li></ul></td>
                    <td><?= $asignado->aS->AS_CANTIDAD ?></td>
                    <td><?= $asignado->aS->sACT->SACT_COSTO ?></td>
                    <td><?= $asignado->aS->AS_COSTOTOTAL ?></td>
                    <td><?= $asignado->aS->AS_CANTIDADACTUAL ?></td>
                    <td><?= $asignado->aS->AS_COSTOACTUAL ?></td>
                    <td class="warning"><?= $asignado->AT_CANTIDAD ?></td>
                    <td class="warning"><?= $asignado->AT_COSTO_EP ?></td>
                </tr>
        <?php } ?>
            </tbody>
       
        </table>
    </div>
</div>








</div>
