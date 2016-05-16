<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ManodeobraTrabajan */

$this->title = 'Create Manodeobra Trabajan';
$this->params['breadcrumbs'][] = ['label' => 'Manodeobra Trabajans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manodeobra-trabajan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
