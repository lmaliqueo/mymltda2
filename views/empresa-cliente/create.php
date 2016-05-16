<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EmpresaCliente */

$this->title = 'Create Empresa Cliente';
$this->params['breadcrumbs'][] = ['label' => 'Empresa Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="empresa-cliente-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
