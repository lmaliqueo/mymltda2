<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SactMatConsume */

$this->title = 'Update Sact Mat Consume: ' . ' ' . $model->CONS_ID;
$this->params['breadcrumbs'][] = ['label' => 'Sact Mat Consumes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->CONS_ID, 'url' => ['view', 'id' => $model->CONS_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sact-mat-consume-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
