<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SueldoObrero */

$this->title = 'Create Sueldo Obrero';
$this->params['breadcrumbs'][] = ['label' => 'Sueldo Obreros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sueldo-obrero-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
