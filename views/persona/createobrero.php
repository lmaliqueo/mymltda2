<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Persona */

$this->title = 'Ingresar Obrero';
$this->params['breadcrumbs'][] = ['label' => 'Personas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="persona-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formobrero', [
        'model' => $model,
        'contrato' => $contrato,
        'sueldo' => $sueldo,
    ]) ?>

</div>
