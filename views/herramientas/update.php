<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Herramientas */

$this->title = 'Update Herramientas: ' . ' ' . $model->HE_ID;
$this->params['breadcrumbs'][] = ['label' => 'Herramientas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->HE_ID, 'url' => ['view', 'id' => $model->HE_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="herramientas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
