<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cargo */

$this->title = 'Update Cargo: ' . ' ' . $model->CA_ID;
$this->params['breadcrumbs'][] = ['label' => 'Cargos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->CA_ID, 'url' => ['view', 'id' => $model->CA_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cargo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
