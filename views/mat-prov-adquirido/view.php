<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MatProvAdquirido */

$this->title = $model->AD_ID;
$this->params['breadcrumbs'][] = ['label' => 'Mat Prov Adquiridos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mat-prov-adquirido-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->AD_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->AD_ID], [
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
            'AD_ID',
            'PROV_ID',
            'MA_ID',
            'TM_ID',
        ],
    ]) ?>

</div>
