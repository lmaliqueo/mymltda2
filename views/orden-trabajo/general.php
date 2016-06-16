<?php

use yii\helpers\Html;
use yii\helpers\Url;
use miloschuman\highcharts\Highcharts;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ActividadesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

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