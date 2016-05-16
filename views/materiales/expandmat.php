<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\Materiales */

?>
<div class="materiales-view">

<br>

<?php 
    Modal::begin([
            'header'=>'<h4>Transaccion</h4>',
            'id'=>'modalTran',
            'size'=>'modal-lg',
        ]);
    echo "<div class='modalContent'></div>";
    Modal::end();
 ?>

    <div class="col-md-5">


        <div class="panel panel-primary">
          <div class="panel-heading"><span class="glyphicon glyphicon glyphicon-magnet" aria-hidden="true"></span> <strong>Material: </strong><?= Html::encode($model->MA_NOMBRE) ?></div>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'MA_ID',
                    'MA_CANTIDADTOTAL',
                    'MA_UNIDAD',
                    'MA_MEDIDA',
                    'MA_TIPOMATERIALES',
                    'MA_COSTOUNIDAD',
                ],
            ]) ?>
    <div class="panel-footer clearfix">
        <div class="pull-right">

             <div class="btn-group" role="group" aria-label="...">
                    <?= Html::a('<span class="glyphicon glyphicon glyphicon-pencil" aria-hidden="true"></span> Update', ['update', 'id' => $model->MA_ID], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('<span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span> Delete', ['delete', 'id' => $model->MA_ID], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Esta seguro de borrar este material',
                            'method' => 'post',
                        ],
                    ]) ?>
            </div>
       </div>
    </div>

        </div>
 

    </div>
    <div class="col-md-4">
         <div class="panel panel-warning">
          <div class="panel-heading"><span class="glyphicon glyphicon glyphicon-th-list" aria-hidden="true"></span> <strong>Stock por OT</strong></div>
           <table class="table table-bordered">
                <tr>
                    <th>Proyecto</th>
                    <th>Orden de Trabajo</th>
                    <th>Cantidad</th>
                    <th></th>
                </tr>
                <?php foreach ($stock as $row): ?>
                <tr>
                                <td><?= $row->oT->pRO->PRO_NOMBRE ?></td>
                                <td><?= $row->oT->OT_NOMBRE ?></td>
                                <td><?= $row->SM_CANTIDAD ?></td>
                                <td><?= Html::a('<span class="glyphicon glyphicon glyphicon-eye-open" aria-hidden="true"></span>', ['orden-trabajo/transaccion', 'id' => $row->OT_ID], ['class' => 'icon icon-primary']) ?></td>

                </tr>
            <?php endforeach ?>


            </table>
    <div class="panel-footer clearfix">
        <div class="pull-right">

        <div class="btn-group" role="group" aria-label="...">
             <?= Html::button('<span class="glyphicon glyphicon glyphicon-transfer" aria-hidden="true"></span> Crear Transacción', ['value'=>Url::to('index.php?r=mat-prov-adquirido/transaccion'),'class'=> 'btn btn-success','id'=>'transaccionModal']) ?>
             <?= Html::button('<span class="glyphicon glyphicon glyphicon-transfer" aria-hidden="true"></span> Ver Movimientos', ['value'=>Url::to('index.php?r=mat-prov-adquirido/transaccion'),'class'=> 'btn btn-primary','id'=>'movimientosModal']) ?>
            

        </div>
        </div>
    </div>

        </div>

    </div>
    <div class="col-md-3">

        <div class="panel panel-success">
          <div class="panel-heading"><span class="glyphicon glyphicon glyphicon-save" aria-hidden="true"></span> <strong>Almacenado en Bodegas</strong></div>
            <table class="table table-bordered">
                <tr>
                    <th>Bodega</th>
                    <th>Cantidad</th>
                </tr>
                <?php foreach ($almacenados as $fila): ?>
                <tr>
                                <td><?= $fila->bO->BO_NOMBRE ?></td>
                                <td><?= $fila->AL_CANTMATERIALES ?></td>
                </tr>
                <?php endforeach ?>


            </table>

        </div>

    </div>


</div>
