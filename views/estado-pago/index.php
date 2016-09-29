<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EstadoPagoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Estado de Pagos';
$this->params['breadcrumbs'][] = ['label' => 'Ordenes de Trabajos', 'url' => ['orden-trabajo/index']];
$this->params['breadcrumbs'][] = [
                    'label' => $ordentrabajo->OT_NOMBRE,
                    //'url' => ['orden-trabajo/index'],
                    'style'=> 'color:white',
                    'template' => "<button class='btn btn-flat btn-sm' style='background-color : #333D43; color:white; float:right; margin-left: 4px;'>{link}</button>\n"
                ];
$this->params['breadcrumbs'][] = 'Estado de pago';
?>
<div class="estado-pago-index">

    <h1>Estados de Pagos</h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


<?php 
    Modal::begin([
            'header'=>'<h4>Ingresar Herramienta</h4>',
            'id'=>'modal',
            'size'=>'modal-lg',
        ]);
    echo "<div class='modalContent'></div>";
    Modal::end();
 ?>



<br>
<div class="row">
    <div class="col-md-3">
            <?= Html::button('Generar Nuevo Estado de Pago', ['value'=>Url::to(['estado-pago/generar-estado-pago', 'id'=>$ordentrabajo->OT_ID]),'class'=> 'btn btn-success btn-block margin-bottom btn-flat','id'=>'modalButton']) ?>
            <?= Html::a('Generar Estado de Pago', ['estado-pago/create', 'id'=>$ordentrabajo->OT_ID], ['class' => 'btn btn-primary btn-block margin-bottom btn-flat']) ?>
            <?= Html::a('Generar Estado de Pago', ['estado-pago/generar-estado-pago', 'id'=>$ordentrabajo->OT_ID], ['class' => 'btn btn-success btn-block margin-bottom btn-flat']) ?>
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
                    <li><?= Html::a('<i class="fa fa-line-chart"></i> Gráfico', ['orden-trabajo/grafico-ot', 'id'=>$ordentrabajo->OT_ID]) ?></li>
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

                    //'EP_ID',
                    //'EP_NUMEROEP',
                    [
                        //'label'=>'Total EP',
                        'attribute'=>'EP_NUMEROEP',
                        'format'=>'raw',
                        'value' => function($data){
                            return 'EP-0'.$data->EP_NUMEROEP;
                        }
                    ],
                    'EP_FECHA:date',
                    'EP_PERIODO',
                    //'EP_TOTALEP',
                    [
                        'label'=>'Total EP',
                        'attribute'=>'EP_TOTALEP',
                        'format'=>'raw',
                        'value' => function($data){
                            return '$ '.$data->EP_TOTALEP;
                        }
                    ],
                    // 'EP_FACTURA',

                    //['class' => 'yii\grid\ActionColumn'],
                    ['class' => 'yii\grid\ActionColumn',
                        'template'=>'{ver}',
                        'buttons' => [
                            'ver' => function ($url,$model) {
                                return Html::a('<i class="fa fa-eye"></i> Ver EP', ['estado-pago/view','id'=>$model->EP_ID], ['class'=>'btn btn-flat btn-default text-blue btn-sm orden', 'idot'=>$model->EP_ID]);
                            },
                        ],
                    ],

                ],
            ]); ?>
        </div>
    </div>
</div>
</div>
