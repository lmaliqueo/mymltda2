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
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            [
                                //'label'=>'N',
                                'attribute'=>'AC_NOMBRE',
                                'format'=>'raw',
                                'value' => function($data){
                                    return Html::a($data->AC_NOMBRE, '#', ['class'=>'modalView text-muted', 'idact'=>$data->AC_ID]);
                                }
                            ],
                            'AC_NOMBRE',
                            'AC_FECHA_INICIO:date',
                            'AC_FECHA_TERMINO:date',
                            'AC_ESTADO',
                            'AC_COSTO_TOTAL',

                            ['class' => 'yii\grid\ActionColumn',
                                'template'=>'{update} {delete}',
                                'buttons' => [
                                    'update' => function ($url,$model) {
                                        return Html::a(
                                            '<span class="glyphicon glyphicon-pencil"></span>',
                                            '#',['class'=>'modalUpdate', 'idact'=>$model->AC_ID, 'title'=>'Actualizar']);
                                    },
                                    'delete' => function ($url,$model) {
                                        return Html::a(
                                            '<span class="glyphicon glyphicon-remove"></span>',
                                            ['delete', 'id'=>$model->AC_ID],['class'=>'text-red', 'title'=>'Eliminar', 
                                                    'data' => [
                                                    'confirm' => '¿Esta seguro de borrar a este Encargado?',
                                                    'method' => 'post',
                                                ],
                                            ]);
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

    $(document).on('click','.modalUpdate',function(){
        var id = $(this).attr('idact');
        $.get('index.php?r=actividades/update',{'id':id},function(data){
             $('#modalUp').modal('show')
             .find('.modalContentUpdate')
             .html(data);
        });

    });


    $(document).on('click','.modalView',function(){
        var id = $(this).attr('idact');
        $.get('index.php?r=actividades/view',{'id':id},function(data){
             $('#modalUp').modal('show')
             .find('.modalContentUpdate')
             .html(data);
        });
    });
JS;
$this->registerJs($script);
?>
