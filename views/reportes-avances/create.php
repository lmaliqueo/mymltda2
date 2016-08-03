<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ReportesAvances */

$this->title = 'Ingresar Reporte de Avances';
$this->params['breadcrumbs'][] = ['label' => 'Reportes Avances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reportes-avances-create">

    <h1><?= Html::encode($this->title) ?></h1>
<br>
    <?= $this->render('_form', [
        'model' => $model,
        'arreglo' => $arreglo,
        'subact' => $subact,
    ]) ?>

</div>
