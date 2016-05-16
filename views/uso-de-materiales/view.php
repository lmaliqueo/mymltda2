<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UsoDeMateriales */

$this->title = $model->UM_ID;
$this->params['breadcrumbs'][] = ['label' => 'Uso De Materiales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uso-de-materiales-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->UM_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->UM_ID], [
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
            'UM_ID',
            'AC_ID',
            'UM_CANTIDADTOTA',
            'UM_COSTOTOTAL',
            'UM_FECHA',
            'UM_ESTADO',
        ],
    ]) ?>

</div>
