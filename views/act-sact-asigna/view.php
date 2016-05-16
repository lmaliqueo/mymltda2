<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ActSactAsigna */

$this->title = $model->AS_ID;
$this->params['breadcrumbs'][] = ['label' => 'Act Sact Asignas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="act-sact-asigna-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->AS_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->AS_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'AS_ID',
            'AC_ID',
            'SACT_ID',
            'AS_CANTIDAD',
            'AS_COSTOTOTAL',
        ],
    ]) ?>

</div>
