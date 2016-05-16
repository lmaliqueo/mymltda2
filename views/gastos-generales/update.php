<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GastosGenerales */

$this->title = 'Update Gastos Generales: ' . ' ' . $model->GG_ID;
$this->params['breadcrumbs'][] = ['label' => 'Gastos Generales', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->GG_ID, 'url' => ['view', 'id' => $model->GG_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="gastos-generales-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
