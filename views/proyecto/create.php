<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Proyecto */

$this->title = 'Crear Proyecto';
$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proyecto-create">

    <h1>Nuevo Proyecto</h1>

    <?= $this->render('_form', [
        'model' => $model,
        'cliente' => $cliente,
    ]) ?>

</div>
