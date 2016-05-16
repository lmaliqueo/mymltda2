<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EstadoHerramientas */

$this->title = 'Create Estado Herramientas';
$this->params['breadcrumbs'][] = ['label' => 'Estado Herramientas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estado-herramientas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
