<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PedidoMateriales */

$this->title = 'Update Pedido Materiales: ' . ' ' . $model->PM_ID;
$this->params['breadcrumbs'][] = ['label' => 'Pedido Materiales', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->PM_ID, 'url' => ['view', 'id' => $model->PM_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pedido-materiales-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
