<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UsoDeMateriales */

$this->title = 'Create Uso De Materiales';
$this->params['breadcrumbs'][] = ['label' => 'Uso De Materiales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uso-de-materiales-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
