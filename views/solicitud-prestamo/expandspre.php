<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SpreHeSolicita */
?>
<div class="solicitud-prestamo-view">

<br>

    <div class="col-md-5">
        <div class="panel panel-primary">
          <div class="panel-heading"><span class="glyphicon glyphicon glyphicon-wrench" aria-hidden="true"></span> <strong>Solicitud: </strong><?= Html::encode($model->SPRE_TITULO) ?></div>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'SPRE_ID',
                    'PE_RUT',
                    'SPRE_FECHA',
                    'SPRE_ESTADO',
                    'SPRE_TEXTO:ntext',
                ],
            ]) ?>

        </div>

    </div>
    <div class="col-md-5">
        <div class="panel panel-warning">
          <div class="panel-heading"><span class="glyphicon glyphicon glyphicon-wrench" aria-hidden="true"></span> <strong>Herramienta: </strong><?= Html::encode($model->SPRE_TITULO) ?></div>


            <table class="table">
                <tr>
                    <th>Herramientas</th>
                    <th>Cantidad</th>
                </tr>
          <?php foreach ($solicita as $row) { ?>
                <tr>
                    <td><?= $row->hE->HE_NOMBRE ?></td>
                    <td><?= $row->SOLI_CANTIDAD ?></td>
                </tr>
          <?php } ?>
            </table>



        </div>

    </div>
    <div class="col-md-1">


        <div class="btn-group-vertical" role="group">


        <?= Html::a('<span class="glyphicon glyphicon glyphicon-ok" aria-hidden="true"></span> Aprobar', ['update', 'id' => $model->SPRE_ID], ['class' => 'btn btn-success',             
            'data' => [
                'confirm' => '¿Estas seguro de aprobar esta solicitud?',
                'method' => 'post',
            ],
        ]) ?>
 
        <?= Html::a('<span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span> Rechazar', ['delete', 'id' => $model->SPRE_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
</div>

    </div>








</div>
