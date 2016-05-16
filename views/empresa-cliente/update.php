<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EmpresaCliente */

$this->title = 'Update Empresa Cliente: ' . ' ' . $model->EMP_RUT;
$this->params['breadcrumbs'][] = ['label' => 'Empresa Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->EMP_RUT, 'url' => ['view', 'id' => $model->EMP_RUT]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="empresa-cliente-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
