<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Herramientas */

$this->title = 'Create Herramientas';
$this->params['breadcrumbs'][] = ['label' => 'Herramientas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="herramientas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
