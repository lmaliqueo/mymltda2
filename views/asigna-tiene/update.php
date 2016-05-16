<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AsignaTiene */

$this->title = 'Update Asigna Tiene: ' . ' ' . $model->AT_ID;
$this->params['breadcrumbs'][] = ['label' => 'Asigna Tienes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->AT_ID, 'url' => ['view', 'id' => $model->AT_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="asigna-tiene-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
