<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TipoObrero */

$this->title = 'Update Tipo Obrero: ' . ' ' . $model->TOB_ID;
$this->params['breadcrumbs'][] = ['label' => 'Tipo Obreros', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->TOB_ID, 'url' => ['view', 'id' => $model->TOB_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tipo-obrero-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
