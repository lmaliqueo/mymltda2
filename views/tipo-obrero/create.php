<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TipoObrero */

$this->title = 'Create Tipo Obrero';
$this->params['breadcrumbs'][] = ['label' => 'Tipo Obreros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-obrero-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
