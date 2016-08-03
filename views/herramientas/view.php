<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Herramientas */

$this->title = $model->HE_ID;
$this->params['breadcrumbs'][] = ['label' => 'Herramientas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="herramientas-view">

<div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="no-margin">  
            <?= $model->HE_ID ?>
            <span class="pull-right">
                <?= Html::a('<i class="fa fa-pencil"></i> Actualizar', ['update', 'id' => $model->HE_ID], ['class' => 'btn bg-light-blue btn-flat']) ?>
            </span>
        </h3>
    </div>
    <div class="box-body">
        <div class="box box-primary">
            <div class="box-body">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        //'HE_ID',
                        'HE_DESCRIPCION',
                        'pROV.PROV_NOMBRE',
                        'bO.BO_NOMBRE',
                        'tH.TH_NOMBRE',
                        'HE_ESTADO',
                        'HE_COSTOUNIDAD',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>





<?php /*
    <p>
        <?= Html::a('Borrar', ['delete', 'id' => $model->HE_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
*/ ?>
</div>


