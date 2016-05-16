<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ContratoObrero */

$this->title = 'Create Contrato Obrero';
$this->params['breadcrumbs'][] = ['label' => 'Contrato Obreros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contrato-obrero-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
