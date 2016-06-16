<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use app\models\Actividades;
use app\models\StockMateriales;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrdenTrabajoTrabajo */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $proyecto->PRO_NOMBRE;
$this->params['breadcrumbs'][] = ['label' => $proyecto->PRO_NOMBRE, 'url' => ['proyecto/view', 'id'=>$proyecto->PRO_ID]];
$this->params['breadcrumbs'][] = 'Ordenes de Trabajos';
?>
<div class="orden-trabajo-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


<?php 
    Modal::begin([
            'header'=>'<h4>Orden de Trabajo</h4>',
            'id'=>'modal',
            'size'=>'modal-lg',
        ]);
    echo "<div class='modalContent'></div>";
    Modal::end();
 ?>

        <h1>Ordenes de Trabajos</h1>
        <br>

<div class="row">
    <div class="col-md-3">
        <div class="otbutton">
            <?= Html::button('<span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Crear Orden de Trabajo', ['value'=>Url::to(['orden-trabajo/create','pro'=>$proyecto->PRO_ID]),'class'=> 'btn btn-success btn-block margin-bottom botonmodal','id'=>'modalButton']) ?>
        </div>

        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Proyecto</h3>
            </div>
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <li><?= Html::a('<i class="fa fa-eye"></i> Detalles', ['proyecto/view', 'id'=>$proyecto->PRO_ID]) ?></li>
                    <?php /*<li class="view" id="<?php echo $model->PRO_ID; ?>"><a href="#"><i class="fa fa-tasks"></i> <span style="padding-left:5px">InformaciÃ³n</span></a></li>*/ ?>
                    <li class="active"><a href="#"><i class="fa fa-tasks"></i> Ordenes de Trabajos</a></li>
                    <li><?= Html::a('<i class="fa fa-file-excel-o"></i> Estados de Pagos', ['estado-pago/index', 'id'=>$proyecto->PRO_ID]) ?></li>
                    <li><?= Html::a('<i class="glyphicon glyphicon-usd"></i> Gastos Generales', ['gastos-generales/index', 'id'=>$proyecto->PRO_ID]) ?></li>
                </ul>
            </div>
        </div>

    </div>




    <div class="col-md-9">
        <?php /*
        <div id="otcontenido">
        <div class="panel box box-solid no-border">
            <?php if ($ordenes==NULL) { ?>
                <div class="box-header"><h3 class="box-title">El proyecto no tiene una orden de trabajo activo</h3></div>
            <?php }else{ ?>
            <div class="box-group">
                <?php foreach ($ordenes as $ot){ ?>
                    <?php if ($ot->OT_ESTADO=='Activo'){ ?>
                        <div class="panel box box-primary no-margin">
                    <?php }elseif($ot->OT_ESTADO=='Pendiente'){ ?>
                        <div class="panel box box-warning no-margin">
                    <?php }else{ ?>
                        <div class="panel box box-success no-margin">
                    <?php } ?>
                        <div class="box-header">
                                 <h4 class="box-title"><?= Html::a($ot->OT_NOMBRE,['orden-trabajo/index-act', 'id'=>$ot->OT_ID]) ?></h4>
                           <div class="box-tools pull-right" style="width: 40%">
                            <div class="progress-group">
                                <span class="progress-text">Actividades</span>
                                <span class="progress-number"><b>1</b>/2</span>
                                <div class="progress xs">
                                    <div class="progress-bar progress-bar-primary" style="width: 50%">
                                    </div>
                                </div>
                            </div>

                            </div>
                        </div>
                    </div>
                <?php } ?>


                        <div class="panel box box-success no-margin">
                            <div class="box-header">
                                     <h4 class="box-title"><a href="#prueba" id="12">prueba</a></h4>
                               <div class="box-tools pull-right" style="width: 40%">
                                <div class="progress-group">
                                    <span class="progress-text">Actividades</span>
                                    <span class="progress-number"><b>1</b>/2</span>
                                    <div class="progress xs">
                                        <div class="progress-bar progress-bar-primary" style="width: 50%">
                                        </div>
                                    </div>
                                </div>

                                </div>
                            </div>
                        </div>

            </div>
        </div>

        </div>
    </div>        
    </div>
*/ ?>
    <div class="box box-primary">
        <div class="box-body no-padding">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'summary'=>'',
                'filterModel' => $searchModel,
                'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                /*
                    [
                        'class' => 'kartik\grid\ExpandRowColumn',
                        'value' => function ($model, $key, $index, $column){
                            return GridView::ROW_COLLAPSED;
                        },
                        'detail' => function ($model, $key, $index, $column){
                            $actividades= Actividades::find()->where(['OT_ID'=>$model->OT_ID, 'AC_ESTADO'=>'En proceso'])->orderBy('AC_FECHA_INICIO')->limit(5)->all();
                            $stock= StockMateriales::find()->where(['OT_ID'=>$model->OT_ID])->limit(5)->all();

                            return Yii::$app->controller->renderPartial('expandot', [
                                    'actividades' => $actividades,
                                    'stock' => $stock,
                                    'model' => $model,
                                ]);
                        },

                    ],*/

                    //'OT_ID',
                    //'pRO.PRO_NOMBRE',
            [
                //'label'=>'N',
                'attribute'=>'OT_NOMBRE',
                'format'=>'raw',
                'value' => function($data){
                    return Html::a($data->OT_NOMBRE, ['orden-trabajo/index-act','id'=>$data->OT_ID], ['class'=>'text-muted', ]);
                }
            ],
                    //'OT_TIPO',
                    'OT_FECHA_INICIO:date',
                    'OT_FECHA_TERMINO:date',
                    'OT_ESTADO',
                    'OT_COSTO_TOTAL',
                    // 'OT_INFORME',

                ],
            ]); ?>
        </div>
    </div>
</div>
</div>
</div>


<?php 
$script = <<< JS
    $('.orden').click(function(){
        var id= $(this).attr('id');
        $.get('index.php?r=orden-trabajo/index-act',{ id : id }, function(data){
            $('#otcontenido').empty();
            $('#otcontenido').append(data);
            $('#modalButton').attr('disabled',true);
        })
    });
JS;
$this->registerJs($script);
?>

