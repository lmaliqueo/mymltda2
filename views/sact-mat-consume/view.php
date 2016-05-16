<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SactMatConsume */

$this->title = $model->CONS_ID;
$this->params['breadcrumbs'][] = ['label' => 'Sact Mat Consumes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sact-mat-consume-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->CONS_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->CONS_ID], [
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
            'CONS_ID',
            'MA_ID',
            'SACT_ID',
            'UM_ID',
            'CONS_CANTMATERIAL',
            'CONS_COSTO',
        ],
    ]) ?>

</div>
