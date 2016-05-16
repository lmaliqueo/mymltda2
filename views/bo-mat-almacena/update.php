<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BoMatAlmacena */

$this->title = 'Update Bo Mat Almacena: ' . ' ' . $model->AL_ID;
$this->params['breadcrumbs'][] = ['label' => 'Bo Mat Almacenas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->AL_ID, 'url' => ['view', 'id' => $model->AL_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bo-mat-almacena-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
