<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PedidoMateriales */

$this->title = $model->PM_ID;
$this->params['breadcrumbs'][] = ['label' => 'Pedido Materiales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-materiales-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->PM_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->PM_ID], [
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
            'PM_ID',
            'PRO_ID',
            'PM_ESTADO',
            'PM_DESCRIPCION',
            'PM_FECHA',
            'PM_TEXTO:ntext',
        ],
    ]) ?>

</div>
