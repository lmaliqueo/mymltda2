<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ReportesAvances */

$this->title = $model->RA_ID;
$this->params['breadcrumbs'][] = ['label' => 'Reportes Avances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reportes-avances-view">





<div class="box">
    <div class="box-body no-padding">
        <div class="mailbox-read-info">
            <h3><?= $model->RA_TITULO ?></h3>
            <h5>
                <strong>Orden de Trabajo: </strong><?= $model->oT->OT_NOMBRE ?>
                <span class="mailbox-read-time pull-right">
                    <?= $model->RA_FECHA ?>
                </span>
            </h5>
        </div>
        <div class="mailbox-read-message">
            <?= $model->RA_DESCRIPCION ?>
        </div>
    </div>
    <div class="box-footer">
        <p>
            <?= Html::a('Actualizar', ['update', 'id' => $model->RA_ID], ['class' => 'btn btn-flat btn-primary']) ?>
            <?= Html::a('Borrar', ['delete', 'id' => $model->RA_ID], [
                'class' => 'btn btn-flat btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    </div>
</div>


</div>
