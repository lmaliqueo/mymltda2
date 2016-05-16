<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Proyecto */

$this->title = 'Update Proyecto: ' . ' ' . $model->PRO_ID;
$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->PRO_ID, 'url' => ['view', 'id' => $model->PRO_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="proyecto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
