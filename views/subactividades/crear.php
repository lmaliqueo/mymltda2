<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Subactividades */

$this->title = 'Create Subactividades';
$this->params['breadcrumbs'][] = ['label' => 'Subactividades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subactividades-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formulario', [
        'model' => $model,
    ]) ?>

</div>
