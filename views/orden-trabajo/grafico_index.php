<?php

use yii\helpers\Html;
use yii\helpers\Url;
use miloschuman\highcharts\Highcharts;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ActividadesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $ordentrabajo->OT_NOMBRE;
$this->params['breadcrumbs'][] = ['label' => 'Orden de Trabajo', 'url' => ['orden-trabajo/index']];
$this->params['breadcrumbs'][] = 'Gráfico';
?>

<?php 
$presupuesto=[];
$avances=[];
$costo_p=0;
foreach ($actividades as $act) {
    $costo_p= $act->AC_COSTO_TOTAL + $costo_p;
    $presupuesto[]=[(strtotime($act->AC_FECHA_TERMINO) * 1000), $costo_p];


 }

$costo_a=0;

foreach ($estado_pago as $ep) {
    $costo_a= $ep->EP_TOTALEP + $costo_a;
    $avances[]=[(strtotime($ep->EP_FECHA) * 1000), $costo_a];


} ?>

<div class="orden-trabajo-index">





    <h1>Gráfico</h1>




<br>




    <div class="row">
        <div class="col-md-3">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Orden de Trabajo</h3>
                </div>
                <div class="box-body no-padding">
                    <ul class="nav nav-pills nav-stacked">
                        <li><?= Html::a('<i class="fa fa-tasks"></i> Actividades', ['orden-trabajo/index-actividades', 'id'=>$ordentrabajo->OT_ID]) ?></li>
                        <li><?= Html::a('<i class="fa fa-file-excel-o"></i> Estados de Pagos', ['orden-trabajo/index-estado-pago', 'id'=>$ordentrabajo->OT_ID]) ?></li>
                        <li><?= Html::a('<i class="fa fa-inbox"></i> Reportes de Avances', ['orden-trabajo/index-reportes-avances', 'id'=>$ordentrabajo->OT_ID]) ?></li>
                        <li><?= Html::a('<i class="glyphicon glyphicon-usd"></i> Gastos Generales', ['orden-trabajo/index-gastos-generales', 'id'=>$ordentrabajo->OT_ID]) ?></li>
                        <li><?= Html::a('<i class="glyphicon glyphicon-list-alt"></i> Materiales', ['orden-trabajo/index-materiales', 'id'=>$ordentrabajo->OT_ID]) ?></li>
                        <li class="active"><a href="#"><i class="fa fa-bar-chart"></i> Gráfico</a></li>
                        <li><?= Html::a('<i class="glyphicon glyphicon-file"></i> Informes', ['proyecto/informes-pro', 'id'=>$ordentrabajo->PRO_ID]) ?></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-9">    
            <div class="box box-primary">
                <?=
                    Highcharts::widget([
                        'options' => [
                            'type'=>'spline',
                        'title' => ['text' => 'Presupuesto - Avances'],
                        'xAxis' => [
                              'title' => ['text' => 'Fecha'],
                              'type' => 'datetime',//$arreglo_x
                                  'dateTimeLabelFormats'=>[
                                      'month'=> '%e. %b',
                                      'year'=> '%b'
                              ],
                        ],
                        'tooltip' =>[
                            'headerFormat'=> '<b>{series.name}</b><br>',
                            'pointFormat'=> '{point.x:%e. %b}: ${point.y}'
                        ],
                        'plotOptions'=>[
                            'lang'=>'es',
                            'spline'=>['marker'=>['enable'=>true]]
                        ],
                        'yAxis' => [
                            'title' => ['text' => 'Costos'],
                        ],
                        'series' => [
                            ['name' => 'Presupuesto', 'data' => $presupuesto],
                            ['name' => 'Avances', 'data' => $avances],
                        ]
                       ]
                    ]);
                ?>
            </div>
        </div>
    </div>

</div>









