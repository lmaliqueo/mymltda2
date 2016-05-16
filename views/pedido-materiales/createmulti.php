<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PedidoMateriales */

$this->title = 'Create Pedido Materiales';
$this->params['breadcrumbs'][] = ['label' => 'Pedido Materiales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-materiales-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formmulti', [
        'model' => $model,
        'padjunta' => $padjunta,
        'stock' => $stock,
    ]) ?>

</div>
