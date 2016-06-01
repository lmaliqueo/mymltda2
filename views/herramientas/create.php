<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Herramientas */

$this->title = 'Ingresar Herramienta';
$this->params['breadcrumbs'][] = ['label' => 'Herramientas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="herramientas-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
