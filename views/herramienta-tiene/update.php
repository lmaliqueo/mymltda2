<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\HerramientaTiene */

$this->title = 'Update Herramienta Tiene: ' . ' ' . $model->HT_ID;
$this->params['breadcrumbs'][] = ['label' => 'Herramienta Tienes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->HT_ID, 'url' => ['view', 'id' => $model->HT_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="herramienta-tiene-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
