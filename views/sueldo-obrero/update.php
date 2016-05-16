<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SueldoObrero */

$this->title = 'Update Sueldo Obrero: ' . ' ' . $model->SU_ID;
$this->params['breadcrumbs'][] = ['label' => 'Sueldo Obreros', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->SU_ID, 'url' => ['view', 'id' => $model->SU_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sueldo-obrero-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
