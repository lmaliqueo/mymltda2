<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\LicitacionPublica */

$this->title = $model->LI_ID;
$this->params['breadcrumbs'][] = ['label' => 'Licitacion Publicas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="licitacion-publica-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->LI_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->LI_ID], [
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
            'LI_ID',
            'LI_ORGANIZACIONRESPONSABLE',
            'LI_NOMBRELICITACION',
            'LI_DESCRIPCION',
            'LI_DETALLESLICITACION:ntext',
            'LI_FECHAPOSTULACION',
            'LI_ESTADO',
            'LI_CIUDAD',
        ],
    ]) ?>

</div>
