<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\EmpresaCliente */

$this->title = $model->EMP_RUT;
$this->params['breadcrumbs'][] = ['label' => 'Empresa Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="empresa-cliente-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->EMP_RUT], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->EMP_RUT], [
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
            'EMP_RUT',
            'COM_ID',
            'EMP_RAZON',
            'EMP_NOMBRE',
            'EMP_RUBRO',
            'EMP_DIRECCION',
            'EMP_TELEFONO',
        ],
    ]) ?>

</div>
