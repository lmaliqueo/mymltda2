<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PedidoAdjunta */

$this->title = 'Create Pedido Adjunta';
$this->params['breadcrumbs'][] = ['label' => 'Pedido Adjuntas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-adjunta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
