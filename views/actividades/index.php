<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ActividadesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

/*$this->title = $ordentrabajo->OT_NOMBRE;
$this->params['breadcrumbs'][] = ['label' => $ordentrabajo->pRO->PRO_NOMBRE, 'url' => ['proyecto/view', 'id'=>$ordentrabajo->PRO_ID]];
$this->params['breadcrumbs'][] = ['label' => $ordentrabajo->OT_NOMBRE, 'url' => ['orden-trabajo/indexpro', 'id'=>$ordentrabajo->PRO_ID]];
$this->params['breadcrumbs'][] = 'Actividades';*/
?>
<div class="actividades-index">
<?php 
    Modal::begin([
            'header'=>'<h4>Actividades</h4>',
            'id'=>'modalUp',
            'size'=>'modal-lg',
        ]);
    echo "<div class='modalContentUpdate'></div>";
    Modal::end();
 ?>
<?php /*
    <h1>Actividades</h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



<br>

<div class="row">
    <div class="col-md-3">
            <?= Html::button('<span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Crear Actividad', ['value'=>Url::to(['actividades/crear','ot'=>$ordentrabajo->OT_ID]),'class'=> 'btn btn-success btn-block margin-bottom','id'=>'modalButton']) ?>
        <div class="box box-solid">
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href="#">Actividades</a></li>
                    <li><?= Html::a('Calendario de Actividades', ['actividades/calendario', 'id'=>$ordentrabajo->PRO_ID]) ?></li>
                     <li><?= Html::a('Reportes de Avances', ['reportes-avances/index', 'id'=>$ordentrabajo->OT_ID]) ?></li>
                    <li><?= Html::a('Movimientos de Materiales', ['orden-trabajo/transaccion', 'id'=>$ordentrabajo->OT_ID]) ?></li>
               </ul>
            </div>
        </div>
    </div>

    <div class="col-md-9">
    </div>
</div>
</div>
                            <?= Html::a('Crear Actividades', ['actividades/crear-calendario', 'id' => $ordentrabajo->OT_ID], ['class' => 'btn btn-primary btn-flat margin-bottom']) ?>
*/ ?>

                    <?= GridView::widget([
    'summary'=>'',
                        'dataProvider' => $dataProvider,
                        //'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            [
                                //'label'=>'N',
                                'attribute'=>'AC_NOMBRE',
                                'format'=>'raw',
                                'value' => function($data){
                                    return Html::a($data->AC_NOMBRE.'<i class="fa fa-eye pull-right"></i> ', '#', ['class'=>'modalView text-muted', 'idact'=>$data->AC_ID, 'title'=>'Ver Actividad']);
                                }
                            ],
                            [
                                //'label'=>'N',
                                'attribute'=>'AC_ESTADO',
                                'format'=>'raw',
                                'value' => function($data){
                                    if ($data->AC_ESTADO == 'Pendiente') {
                                        return '<span class="label label-warning">'.$data->AC_ESTADO.'</span>';
                                    }elseif ($data->AC_ESTADO == 'En proceso') {
                                        return '<span class="label label-primary">'.$data->AC_ESTADO.'</span>';
                                    }elseif ($data->AC_ESTADO == 'Finalizado') {
                                        return '<span class="label label-success">'.$data->AC_ESTADO.'</span>';
                                    }
                                }
                            ],
                            'AC_FECHA_INICIO:date',
                            'AC_FECHA_TERMINO:date',
                            //'AC_ESTADO',
                            //'AC_COSTO_TOTAL',
                            [
                                'attribute'=>'AC_COSTO_TOTAL',
                                'value' => function($data){
                                    return '$ '.$data->AC_COSTO_TOTAL;
                                }
                            ],

                            ['class' => 'yii\grid\ActionColumn',
                                'template'=>'{update} {delete}',
                                'buttons' => [
                                    'update' => function ($url,$model) {
                                        return Html::button(
                                            '<i class="fa fa-pencil"></i> Actualizar', [
                                                'value'=>Url::to(['actividades/update','id'=>$model->AC_ID]),
                                                'class'=>'btn btn-sm btn-flat btn-default text-blue modalAct',
                                                'title'=>'Actualizar'
                                        ]);
                                    },
                                    'delete' => function ($url,$model) {
                                        if ($model->AC_ESTADO=='Pendiente') {
                                            return Html::a(
                                                '<i class="fa fa-close"></i> Eliminar',
                                                ['delete', 'id'=>$model->AC_ID],['class'=>'btn btn-default text-red btn-flat btn-sm', 'title'=>'Eliminar', 
                                                    'data' => [
                                                        'confirm' => '¿Esta seguro de Eliminar esta actividad?',
                                                        'method' => 'post',
                                                    ],
                                                ]);
                                        }
                                    },
                                ],
                            ],
                        ],
    'options'=>['class'=>'grid-view gridview-newclass'],
    //'tableOptions' =>['class' => 'table table-hover table-bordered'],
                    ]); ?>


</div>

<?php 
$script = <<< JS


    $('.modalAct').click(function() {
        $('#modalUp').modal('show')
        .find('.modalContentUpdate')
        .load($(this).attr('value'));
    });


    $(document).on('click','.modalUpdate',function(){
        var id = $(this).attr('idact');
        $.get('../actividades/update',{'id':id},function(data){
             $('#modalUp').modal('show')
             .find('.modalContentUpdate')
             .html(data);
        });

    });


    $(document).on('click','.modalView',function(){
        var id = $(this).attr('idact');
        $.get('../actividades/view',{'id':id},function(data){
             $('#modalUp').modal('show')
             .find('.modalContentUpdate')
             .html(data);
        });
    });
JS;
$this->registerJs($script);
?>
