<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\Materiales */

$this->title = $model->MA_NOMBRE;
$this->params['breadcrumbs'][] = ['label' => 'Materiales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="materiales-view">

<div class="box box-primary">
    <div class="box-header with-border">
        <h4 class="box-title text-blue"><strong><?= $model->MA_NOMBRE ?></strong></h4>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-4">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'MA_ID',
                        //'MA_NOMBRE',
                        'tMA.TMA_NOMBRE',
                        'MA_CANTIDADTOTAL',
                        'MA_UNIDAD',
                        'MA_COSTOUNIDAD',
                    ],
                ]) ?>
                <table class="table">
                    <tr class="bg-light-blue">
                        <th>Bodega</th>
                        <th>Cantidad</th>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-8">
                        <table class="table">
                            <tr class="bg-blue">
                                <th>Proyecto</th>
                                <th>OT</th>
                                <th>Cantidad</th>
                            </tr>
                            <?php //foreach ($variable as $key => $value) { ?>
                                <tr>
                                    <td></td>
                                </tr>
                            <?php //} ?>
                        </table>
            </div>
        </div>
     
    </div>
    <div class="box-footer">
        <?= Html::a('Actualizar', ['update', 'id' => $model->MA_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->MA_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro de borrar este material',
                'method' => 'post',
            ],
        ]) ?>
    </div>
</div>

</div>
