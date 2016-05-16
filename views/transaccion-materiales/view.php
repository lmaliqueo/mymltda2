<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TransaccionMateriales */

$this->title = $model->TM_ID;
$this->params['breadcrumbs'][] = ['label' => 'Transaccion Materiales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaccion-materiales-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->TM_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->TM_ID], [
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
            'TM_ID',
            'SM_ID',
            'TM_FECHACOMPRA',
            'TM_PRECIO',
            'TM_CANTIDAD',
        ],
    ]) ?>

</div>
