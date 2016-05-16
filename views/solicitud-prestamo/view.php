<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SolicitudPrestamo */

$this->title = $model->SPRE_ID;
$this->params['breadcrumbs'][] = ['label' => 'Solicitud Prestamos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="solicitud-prestamo-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
            'SPRE_TITULO',
            'SPRE_FECHA',
            'SPRE_ESTADO',
            'SPRE_DESCRIPCION:ntext',
        ],
    ]) ?>

</div>
