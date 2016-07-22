<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EstadoPagoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $ordentrabajo->OT_NOMBRE;
$this->params['breadcrumbs'][] = ['label' => 'Estados de Pagos', 'url' => ['ordentrabajo/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estado-pago-index">

    <h1>Estados de Pagos</h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>





<br>
<div class="row">
    <div class="col-md-3">
            <?= Html::a('<span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Generar Estado de Pago', ['create', 'id'=>$ordentrabajo->OT_ID], ['class' => 'btn btn-success btn-block margin-bottom btn-flat']) ?>
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Orden de Trabajo</h3>
            </div>
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <li><?= Html::a('<i class="fa fa-tasks"></i> Actividades', ['orden-trabajo/index-actividades', 'id'=>$ordentrabajo->OT_ID]) ?></li>
                    <li class="active"><a href="#"><i class="fa fa-file-excel-o"></i> Estado de Pagos</a></li>
                    <li><?= Html::a('<i class="fa fa-inbox"></i> Reportes de Avances', ['orden-trabajo/index-reportes-avances', 'id'=>$ordentrabajo->OT_ID]) ?></li>
                    <li><?= Html::a('<i class="glyphicon glyphicon-usd"></i> Gastos Generales', ['orden-trabajo/index-gastos-generales', 'id'=>$ordentrabajo->OT_ID]) ?></li>
                    <li><?= Html::a('<i class="glyphicon glyphicon-list-alt"></i> Materiales', ['orden-trabajo/index-materiales', 'id'=>$ordentrabajo->OT_ID]) ?></li>
                    <li><?= Html::a('<i class="fa fa-bar-chart"></i> Gráfico', ['orden-trabajo/grafico-ot', 'id'=>$ordentrabajo->OT_ID]) ?></li>
                    <li><?= Html::a('<i class="glyphicon glyphicon-file"></i> Informes', ['proyecto/informes-pro', 'id'=>$ordentrabajo->PRO_ID]) ?></li>
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
