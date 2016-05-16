<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\StockMateriales */

$this->title = 'Create Stock Materiales';
$this->params['breadcrumbs'][] = ['label' => 'Stock Materiales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-materiales-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
