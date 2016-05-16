<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\Materiales */

$this->title = $model->MA_NOMBRE;
$this->params['breadcrumbs'][] = ['label' => 'Materiales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="materiales-view">

    <h1 class="text-center"><strong><?= Html::encode($this->title) ?></strong></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->MA_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->MA_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro de borrar este material',
                'method' => 'post',
            ],
        ]) ?>
    </p>

<div class="row">
    <div class="col-md-6">
        <h3 class="text-center">Detalles de <?= Html::encode($this->title) ?></h3>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'MA_ID',
            'MA_NOMBRE',
            'MA_CANTIDADTOTAL',
            'MA_UNIDAD',
            'MA_MEDIDA',
            'MA_TIPOMATERIALES',
            'MA_COSTOUNIDAD',
        ],
    ]) ?>
 

    </div>
    <div class="col-md-offset-6">

         <h3 class="text-center">Almacenado en Bodegas</h3>
   <table class="table table-bordered">
        <tr>
            <th>Bodega</th>
            <th>Cantidad</th>
        </tr>
        <?php foreach ($almacena as $fila): ?>
        <tr>
                        <td><?= Html::a($fila->bO->BO_NOMBRE,['bodegas/view', 'id'=>$fila->BO_ID], ['id'=>'modalButton']) ?></td>
                        <?php
                            Modal::begin(['id' =>'popupModal']);
                            echo "<div id='modalContent'></div>";
                            Modal::end();
                        ?>

                        <td><?= $fila->AL_CANTMATERIALES ?></td>
<div></div>
        </tr>
        <?php endforeach ?>


    </table>

    </div>
</div>

<div class="row">
    <div class="col-md-6">
                <h3 class="text-center">Stock por OT</h3>
        <table class="table table-bordered">
            <tr>
                <th>Proyecto</th>
                <th>Orden de Trabajo</th>
                <th>Cantidad Total por OT</th>
            </tr>
            <?php foreach ($stock as $row): ?>
            <tr>
                            <td><?= Html::a($row->oT->pRO->PRO_NOMBRE,['proyecto/view','id'=>$row->oT->PRO_ID]) ?></td>
                            <td><?= Html::a($row->oT->OT_NOMBRE,['orden-trabajo/view','id'=>$row->OT_ID]) ?></td>
                            <td><?= $row->SM_CANTIDAD ?></td>

            </tr>
        <?php endforeach ?>


        </table>

    </div>
    <div class="col-md-offset-6">
                <h3 class="text-center">Adquiridos</h3>
    <table class="table table-bordered">
        <tr>
            <th>Proveedor</th>
            <th>Cantidad</th>
            <th>Costo</th>
            <th>Fecha</th>
        </tr>
        <?php foreach ($adquirido as $key): ?>
        <tr>
                        <td><?= Html::a($key->pROV->PROV_NOMBRE, ['proveedor/view', 'id'=>$key->PROV_ID]) ?></td>
                        <td><?= $key->tM->TM_CANTIDAD ?></td>
                        <td><?= $key->tM->TM_PRECIO ?></td>
                        <td><?= $key->tM->TM_FECHACOMPRA ?></td>

        </tr>
        <?php endforeach ?>


    </table>

    </div>
</div>
</div>
