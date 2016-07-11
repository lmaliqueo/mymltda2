<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\Materiales */

?>
<div class="materiales-view">

    
    <div class="box box-solid">
        <div class="box-header bg-light-blue">
            <h4 class="box-title">Datos de la Orden de Compra</h4>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <label class="control-label">N° ORDEN DE COMPRA: </label>
                    <?= $orden_compra->ORC_NUMERO_ORDEN ?>
                    <br>
                    <label class="control-label">ESTADO: </label>
                    <label class="badge bg-yellow"><?= $orden_compra->ORC_ESTADO ?></label>
                    <br>
                    <label class="control-label">PROYECTO: </label>
                    <?= $orden_compra->oT->pRO->PRO_NOMBRE ?>
                    <br>
                    <label class="control-label">DIRECCIÓN: </label>
                    <?= $orden_compra->oT->pRO->PRO_DIRECCION ?>
                    <br>
                    <label class="control-label">PROVEEDOR: </label>
                    <?= $orden_compra->pROV->PROV_NOMBRE ?>
                </div>
                <div class="col-md-6">
                    <label class="control-label">FECHA PEDIDO: </label>
                    <?= $orden_compra->ORC_FECHA_PEDIDO ?>
                    <br>
                    <label class="control-label">FECHA PAGO: </label>
                    <?= $orden_compra->ORC_FECHA_PAGO ?>
                    <br>
                    <label class="control-label">CIUDAD: </label>
                    <?= $orden_compra->oT->pRO->cOM->COM_NOMBRE ?>
                    <br>
                    <label class="control-label">ORDEN DE TRABAJO: </label>
                    <?= $orden_compra->oT->OT_NOMBRE ?>
                    <br>
                    <label class="control-label">ENVIAR: </label>
                    <label class="badge bg-blue" id="destino_mat"><?= $envio ?></label>
                </div>
            </div>
        </div>
    </div>

    <div class="box box-solid">
        <div class="box-header with-border">
            <h4 class="box-title">Materiales</h4>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <tr class="bg-light-blue">
                    <th>Cantidad</th>
                    <th>Descripción</th>
                    <th>Tipo Material</th>
                    <th>Unidad</th>
                    <th>Costo</th>
                </tr>
                <?php foreach ($compras as $compra) { ?>
                    <tr>
                        <td><?= $compra->AD_CANTIDAD ?></td>
                        <td><?= $compra->mA->MA_NOMBRE ?></td>
                        <td><?= $compra->mA->tMA->TMA_NOMBRE ?></td>
                        <td><?= $compra->mA->MA_UNIDAD ?></td>
                        <td>$ <?= $compra->AD_COSTO_TOTAL ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <th colspan="3"></th>
                    <th class="text-right success">TOTAL:</th>
                    <th class="success">$ <?= $orden_compra->ORC_COSTO_TOTAL ?></th>
                </tr>
            </table>

        </div>
    </div>

    <?php 
        if ($orden_compra->ORC_ESTADO=='Pendiente') {
            echo Html::a('Autorizar', ['autorizar-orden-compra', 'id' => $orden_compra->ORC_ID], [
                'class' => 'btn btn-success btn-flat',
                'data' => [
                'confirm' => '¿Esta seguro de AUTORIZAR esta Orden de Compra?',
                'method' => 'post',
                ],
            ]);
            echo Html::a('Anular', ['anular-orden-compra', 'id' => $orden_compra->ORC_ID], [
                'class' => 'btn btn-danger btn-flat',
                'data' => [
                    'confirm' => '¿Esta seguro de ANULAR esta Orden de Compra?',
                    'method' => 'post',
                ],
            ]);
        }
     ?>
</div>
