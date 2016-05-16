<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TransaccionMateriales */

$this->title = 'Update Transaccion Materiales: ' . ' ' . $model->TM_ID;
$this->params['breadcrumbs'][] = ['label' => 'Transaccion Materiales', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->TM_ID, 'url' => ['view', 'id' => $model->TM_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="transaccion-materiales-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
