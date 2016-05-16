<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Subactividades */

$this->title = $model->SACT_ID;
$this->params['breadcrumbs'][] = ['label' => 'Subactividades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subactividades-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->SACT_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Asignar', ['asignar', 'id' => $model->SACT_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->SACT_ID], [
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
            'SACT_ID',
            'SACT_NOMBRE',
            'SACT_DESCRIPCION:ntext',
            'SACT_COSTO',
        ],
    ]) ?>

</div>
