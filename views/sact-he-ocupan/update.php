<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SactHeOcupan */

$this->title = 'Update Sact He Ocupan: ' . ' ' . $model->OC_ID;
$this->params['breadcrumbs'][] = ['label' => 'Sact He Ocupans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->OC_ID, 'url' => ['view', 'id' => $model->OC_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sact-he-ocupan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
