<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SpreHeSolicita */
?>
<div class="solicitud-prestamo-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->SPRE_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->SPRE_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'SPRE_ID',
            'PE_RUT',
            'SPRE_DESCRIPCION',
            'SPRE_FECHA',
            'SPRE_ESTADO',
            'SPRE_TEXTO:ntext',
        ],
    ]) ?>


    <div class="panel panel-primary">
      <!-- Default panel contents -->
      <div class="panel-heading"><span class="glyphicon glyphicon glyphicon-wrench" aria-hidden="true"></span> <strong>Herramienta: </strong><?= Html::encode($model->SPRE_DESCRIPCION) ?></div>


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
