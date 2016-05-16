<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MatProvAdquirido */

$this->title = 'Update Mat Prov Adquirido: ' . ' ' . $model->AD_ID;
$this->params['breadcrumbs'][] = ['label' => 'Mat Prov Adquiridos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->AD_ID, 'url' => ['view', 'id' => $model->AD_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mat-prov-adquirido-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
