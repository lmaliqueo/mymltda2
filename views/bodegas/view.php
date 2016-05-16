<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Bodegas */

$this->title = $model->BO_ID;
$this->params['breadcrumbs'][] = ['label' => 'Bodegas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bodegas-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->BO_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->BO_ID], [
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
            'BO_ID',
            'BO_NOMBRE',
            'BO_DIRECCION',
            'BO_CANTIDADHERRAMIENTAS',
            'BO_CANTIDADMATERIALES',
        ],
    ]) ?>

</div>
