<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ContratoObrero */

$this->title = $model->COO_ID;
$this->params['breadcrumbs'][] = ['label' => 'Contrato Obreros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contrato-obrero-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->COO_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->COO_ID], [
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
            'COO_ID',
            'PE_RUT',
            'COO_FECHA',
            'COO_ESTADO',
            'COO_SUELDO',
            'COO_HORAS',
        ],
    ]) ?>

</div>
