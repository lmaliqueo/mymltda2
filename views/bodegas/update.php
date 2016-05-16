<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Bodegas */

$this->title = 'Update Bodegas: ' . ' ' . $model->BO_ID;
$this->params['breadcrumbs'][] = ['label' => 'Bodegas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->BO_ID, 'url' => ['view', 'id' => $model->BO_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bodegas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
