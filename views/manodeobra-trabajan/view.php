<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ManodeobraTrabajan */

$this->title = $model->TRAB_ID;
$this->params['breadcrumbs'][] = ['label' => 'Manodeobra Trabajans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manodeobra-trabajan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->TRAB_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->TRAB_ID], [
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
            'TRAB_ID',
            'PE_RUT',
            'AC_ID',
        ],
    ]) ?>

</div>
