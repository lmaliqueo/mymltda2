<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UsoDeMateriales */

$this->title = 'Update Uso De Materiales: ' . ' ' . $model->UM_ID;
$this->params['breadcrumbs'][] = ['label' => 'Uso De Materiales', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->UM_ID, 'url' => ['view', 'id' => $model->UM_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="uso-de-materiales-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
