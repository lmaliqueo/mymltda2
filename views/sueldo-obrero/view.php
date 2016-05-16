<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SueldoObrero */

$this->title = $model->SU_ID;
$this->params['breadcrumbs'][] = ['label' => 'Sueldo Obreros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sueldo-obrero-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->SU_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->SU_ID], [
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
            'SU_ID',
            'COO_ID',
            'SU_CANTIDAD',
            'SU_FECHA',
        ],
    ]) ?>

</div>
