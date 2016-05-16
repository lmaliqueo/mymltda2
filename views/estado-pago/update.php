<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EstadoPago */

$this->title = 'Update Estado Pago: ' . ' ' . $model->EP_ID;
$this->params['breadcrumbs'][] = ['label' => 'Estado Pagos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->EP_ID, 'url' => ['view', 'id' => $model->EP_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="estado-pago-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
