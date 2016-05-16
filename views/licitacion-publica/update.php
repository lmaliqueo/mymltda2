<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LicitacionPublica */

$this->title = 'Update Licitacion Publica: ' . ' ' . $model->LI_ID;
$this->params['breadcrumbs'][] = ['label' => 'Licitacion Publicas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->LI_ID, 'url' => ['view', 'id' => $model->LI_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="licitacion-publica-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
