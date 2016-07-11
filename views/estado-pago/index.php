<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EstadoPagoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $proyecto->PRO_NOMBRE;
$this->params['breadcrumbs'][] = ['label' => $proyecto->PRO_NOMBRE, 'url' => ['proyecto/view', 'id'=>$proyecto->PRO_ID]];
$this->params['breadcrumbs'][] = 'Estados de Pagos';
?>
<div class="estado-pago-index">

    <h1>Estados de Pagos</h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>





<br>
<div class="row">
    <div class="col-md-3">
            <?= Html::a('<span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Generar Estado de Pago', ['create', 'id'=>$proyecto->PRO_ID], ['class' => 'btn btn-success btn-block margin-bottom']) ?>
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Proyecto</h3>
            </div>
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <li><?= Html::a('<i class="fa fa-eye"></i> Detalles', ['proyecto/view', 'id'=>$proyecto->PRO_ID]) ?></li>
                    <li><?= Html::a('<i class="fa fa-tasks"></i> Ordenes de Trabajos', ['orden-trabajo/indexpro', 'id'=>$proyecto->PRO_ID]) ?></li>
                    <li class="active"><a href="#"><i class="fa fa-file-excel-o"></i> Estado de Pagos</a></li>
                    <li><?= Html::a('<i class="fa fa-inbox"></i> Reportes de Avances', ['reportes-avances/index', 'id'=>$proyecto->PRO_ID]) ?></li>
                    <li><?= Html::a('<i class="glyphicon glyphicon-usd"></i> Gastos Generales', ['gastos-generales/index', 'id'=>$proyecto->PRO_ID]) ?></li>
                    <li><?= Html::a('<i class="glyphicon glyphicon-list-alt"></i> Materiales', ['materiales/materiales-pro', 'id'=>$proyecto->PRO_ID]) ?></li>
                    <li><?= Html::a('<i class="glyphicon glyphicon-file"></i> Informes', ['proyecto/informes-pro', 'id'=>$proyecto->PRO_ID]) ?></li>
                </ul>
            </div>
        </div>
    </div>



    <div class="col-md-9">    
        <div class="box box-primary">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
    'summary'=>'',
    'showOnEmpty'=>true,
                //'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'EP_ID',
                    'EP_NUMEROEP',
                    'EP_FECHA',
                    'EP_PERIODO',
                    'EP_TOTALEP',
                    // 'EP_FACTURA',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>
</div>
