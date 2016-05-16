<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\OrdenTrabajo */

$this->title = $model->OT_NOMBRE;
$this->params['breadcrumbs'][] = ['label' => 'Orden de Trabajos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orden-trabajo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->OT_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Transaccion de materiales', ['transaccion', 'id' => $model->OT_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->OT_ID], [
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
            'OT_ID',
            'PRO_ID',
            'OT_NOMBRE',
            'OT_TIPO',
            'OT_FECHA_INICIO',
            'OT_FECHA_TERMINO',
            'OT_ESTADO',
            'OT_COSTO_TOTAL',
            'OT_INFORME',
        ],
    ]) ?>

</div>
