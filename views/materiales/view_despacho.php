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
        <div class="box-header bg-gray">
            <h4 class="box-title">Datos de la Orden de Despacho</h4>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">

                    <label class="control-label">N° ORDEN DE COMPRA: </label>
                    <?= $orden_despacho->OD_NUMERO_ORDEN ?>
                    <br>
                    <label class="control-label">ESTADO: </label>
                    <label class="badge bg-yellow"><?= $orden_despacho->OD_ESTADO ?></label>
                    <br>
                    <label class="control-label">PROYECTO: </label>
                    <?= $orden_despacho->oT->pRO->PRO_NOMBRE ?>
                    <br>
                    <label class="control-label">DIRECCIÓN: </label>
                    <?= $orden_despacho->oT->pRO->PRO_DIRECCION ?>
                    <br>
                </div>
                <div class="col-md-6">



                    <label class="control-label">FECHA EMISIÓN: </label>
                    <?= $orden_despacho->OD_FECHA_EMISION ?>
                    <br>
                    <label class="control-label">FECHA RECEPCIÓN: </label>
                    <?= $orden_despacho->OD_FECHA_RECEPCION ?>
                    <br>
                    <label class="control-label">CIUDAD: </label>
                    <?= $orden_despacho->oT->pRO->cOM->COM_NOMBRE ?>
                    <br>
                    <label class="control-label">ORDEN DE TRABAJO: </label>
                    <?= $orden_despacho->oT->OT_NOMBRE ?>
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
                <tr class="bg-gray">
                    <th>Código</th>
                    <th>Descripción</th>
                    <th>Tipo Material</th>
                    <th>Bodega</th>
                    <th>Unidad</th>
                    <th>Cantidad</th>
                </tr>
                <?php foreach ($despachos as $despacho) { ?>
                    <tr>
                        <td><?= $despacho->AL_ID ?></td>
                        <td><?= $despacho->aL->mA->MA_NOMBRE ?></td>
                        <td><?= $despacho->aL->mA->tMA->TMA_NOMBRE ?></td>
                        <td><?= $despacho->aL->bO->BO_NOMBRE ?></td>
                        <td><?= $despacho->aL->mA->MA_UNIDAD ?></td>
                        <th class="text-center active"><?= $despacho->ESP_CANTIDAD_DESPACHO ?></th>
                    </tr>
                <?php } ?>
            </table>

        </div>
    </div>

    <?php 
        if ($orden_despacho->OD_ESTADO=='Pendiente') {
            echo Html::a('Autorizar', ['autorizar-orden-despacho', 'id' => $orden_despacho->OD_ID], [
                'class' => 'btn btn-success btn-flat',
                'data' => [
                'confirm' => '¿Esta seguro de AUTORIZAR este Orden de Despacho?',
                'method' => 'post',
                ],
            ]);
            echo Html::a('Anular', ['denegar-orden-despacho', 'id' => $orden_despacho->OD_ID], [
                'class' => 'btn btn-danger btn-flat',
                'data' => [
                    'confirm' => '¿Esta seguro de ANULAR este Orden de Despacho?',
                    'method' => 'post',
                ],
            ]);
        }
     ?>
</div>
