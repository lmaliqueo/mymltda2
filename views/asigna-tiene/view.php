<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AsignaTiene */

$this->title = $model->AT_ID;
$this->params['breadcrumbs'][] = ['label' => 'Asigna Tienes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asigna-tiene-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->AT_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->AT_ID], [
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
            'AT_ID',
            'AS_ID',
            'EP_ID',
            'AT_CANTIDAD',
            'AT_COSTO_EP',
        ],
    ]) ?>

</div>
