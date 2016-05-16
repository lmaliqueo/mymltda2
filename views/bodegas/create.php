<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Bodegas */

$this->title = 'Create Bodegas';
$this->params['breadcrumbs'][] = ['label' => 'Bodegas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bodegas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
