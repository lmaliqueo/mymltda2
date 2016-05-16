<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ReportesAvances */

$this->title = 'Create Reportes Avances';
$this->params['breadcrumbs'][] = ['label' => 'Reportes Avances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reportes-avances-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
