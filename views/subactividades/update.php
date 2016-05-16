<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Subactividades */

$this->title = 'Update Subactividades: ' . ' ' . $model->SACT_ID;
$this->params['breadcrumbs'][] = ['label' => 'Subactividades', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->SACT_ID, 'url' => ['view', 'id' => $model->SACT_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="subactividades-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
