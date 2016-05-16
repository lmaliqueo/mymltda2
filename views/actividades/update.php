<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Actividades */

$this->title = 'Update Actividades: ' . ' ' . $model->AC_ID;
$this->params['breadcrumbs'][] = ['label' => 'Actividades', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->AC_ID, 'url' => ['view', 'id' => $model->AC_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="actividades-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
