<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Proveedor */

$this->title = 'Update Proveedor: ' . ' ' . $model->PROV_ID;
$this->params['breadcrumbs'][] = ['label' => 'Proveedors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->PROV_ID, 'url' => ['view', 'id' => $model->PROV_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="proveedor-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
