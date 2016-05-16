<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PedidoAdjunta */

$this->title = 'Update Pedido Adjunta: ' . ' ' . $model->PV_ID;
$this->params['breadcrumbs'][] = ['label' => 'Pedido Adjuntas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->PV_ID, 'url' => ['view', 'id' => $model->PV_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pedido-adjunta-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
