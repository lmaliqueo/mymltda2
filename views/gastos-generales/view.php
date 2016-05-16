<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\GastosGenerales */

$this->title = $model->GG_ID;
$this->params['breadcrumbs'][] = ['label' => 'Gastos Generales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gastos-generales-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->GG_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->GG_ID], [
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
            'GG_ID',
            'PRO_ID',
            'GG_TIPO',
            'GG_DESCRIPCION',
            'GG_COSTO',
            'GG_TEXT:ntext',
        ],
    ]) ?>

</div>
