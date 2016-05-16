<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\HerramientaTiene */

$this->title = 'Create Herramienta Tiene';
$this->params['breadcrumbs'][] = ['label' => 'Herramienta Tienes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="herramienta-tiene-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
