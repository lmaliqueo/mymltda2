<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GastosGenerales */

$this->title = 'Create Gastos Generales';
$this->params['breadcrumbs'][] = ['label' => 'Gastos Generales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gastos-generales-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
