<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BoMatAlmacena */

$this->title = $model->AL_ID;
$this->params['breadcrumbs'][] = ['label' => 'Bo Mat Almacenas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bo-mat-almacena-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->AL_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->AL_ID], [
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
            'AL_ID',
            'BO_ID',
            'MA_ID',
            'AL_CANTMATERIALES',
        ],
    ]) ?>

</div>
