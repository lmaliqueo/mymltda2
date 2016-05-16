<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GastosGeneralesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $proyecto->PRO_NOMBRE;
$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['proyecto/index']];
$this->params['breadcrumbs'][] = ['label' => $proyecto->PRO_NOMBRE, 'url' => ['proyecto/view', 'id'=>$proyecto->PRO_ID]];
$this->params['breadcrumbs'][] = 'Gastos Generales';
?>
<div class="gastos-generales-index">

    <h1>Gastos Generales</h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<br>


<?php 
    Modal::begin([
            'header'=>'<h4>Gastos Generales</h4>',
            'id'=>'modal',
            'size'=>'modal-lg',
        ]);
    echo "<div class='modalContent'></div>";
    Modal::end();
 ?>


<div class="row">
    <div class="col-md-3">
            <?= Html::button('<span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Crear Gastos Generales', ['value'=>Url::to(['gastos-generales/create','id'=>$proyecto->PRO_ID]),'class'=> 'btn btn-success btn-block margin-bottom','id'=>'modalButton']) ?>
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Operaciones</h3>
            </div>
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <li><?= Html::a('<i class="fa fa-eye"></i> Proyecto', ['proyecto/view', 'id'=>$proyecto->PRO_ID]) ?></li>
                    <li><?= Html::a('<i class="fa fa-tasks"></i> Ordenes de Trabajos', ['orden-trabajo/indexpro', 'id'=>$proyecto->PRO_ID]) ?></li>
                    <li><?= Html::a('<i class="fa fa-file-excel-o"></i> Estados de Pagos', ['estado-pago/index', 'id'=>$proyecto->PRO_ID]) ?></li>
                    <li class="active"><a href="#"><i class="glyphicon glyphicon-usd"></i> Gastos Generales</a></li>
                </ul>
            </div>
        </div>
    </div>




    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'GG_ID',
                        'PRO_ID',
                        'GG_TIPO',
                        'GG_DESCRIPCION',
                        'GG_COSTO',
                        // 'GG_TEXT:ntext',

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>

            </div>
        </div>
    </div>
</div>
</div>
