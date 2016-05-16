<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EstadoHerramientas */

$this->title = 'Update Estado Herramientas: ' . ' ' . $model->EH_ID;
$this->params['breadcrumbs'][] = ['label' => 'Estado Herramientas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->EH_ID, 'url' => ['view', 'id' => $model->EH_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="estado-herramientas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
