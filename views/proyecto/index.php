<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProyectoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Proyectos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proyecto-index">

    <h1>Proyectos</h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<br>

<div class="row">
    <div class="col-md-3">
        <?= Html::a('Crear Proyecto', ['create'], ['class' => 'btn btn-success btn-flat btn-block margin-bottom']) ?>
    </div>
    <div class="col-md-9">
        <div class="box box-solid collapsed-box">
            <div class="box-header with-border">
                <h5 class="no-margin text-blue" style="height: 15px;"><span class="glyphicon glyphicon-search"></span> <strong>Buscar</strong></h5>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body" style="display: none;">
                <?php echo $this->render('_search', ['model' => $searchModel]); ?>
            </div>
        </div>
    </div>
</div>




<div class="box box-primary">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary'=>'',
        //'filterModel' => $searchModel,
        'emptyCell'=>'-',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            [
                //'label'=>'N',
                'attribute'=>'PRO_NOMBRE',
                'format'=>'raw',
                'value' => function($data){
                    return Html::a($data->PRO_NOMBRE, ['proyecto/view','id'=>$data->PRO_ID], ['class'=>'text-muted', ]);
                }
            ],

            //'PRO_NOMBRE',
                        [
                            'label'=>'Cliente',
                            'attribute'=>'EMP_RUT',
                            'value'=>'eMPRUT.EMP_RAZON',
                        ],
                        [
                            'attribute'=>'COM_ID',
                            'value'=>'cOM.COM_NOMBRE',
                        ],
             'PRO_FECHA_INICIO:date',
             /*
             [
                'attribute'=>'PRO_FECHA_INICIO',
                'value'=>'PRO_FECHA_INICIO',
                'format'=>'raw',
                'filter'=>DatePicker::widget([
                            'model' => $searchModel,
                            'attribute' => 'PRO_FECHA_INICIO',
                                'clientOptions' => [
                                    'autoclose' => true,
                                    'format' => 'yyyy-mm-dd'
                                ]
                        ])
             ],*/
             'PRO_DIRECCION',
            'PRO_ESTADO',
             //'PRO_OBSERVACIONES:ntext',
            // 'PRO_DESCRIPCION',
             //'PRO_COSTO_TOTAL',
            // 'PRO_INFORME',

            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{ver} {modificar}',
                'buttons' => [
                    'ver' => function ($url,$model) {
                        return Html::a('<i class="fa fa-eye"></i> Ver', ['view', 'id'=>$model->PRO_ID],['class'=>'btn btn-default text-blue btn-flat btn-sm']);
                    },
                    'modificar' => function ($url,$model) {
                        return Html::a('<i class="fa fa-pencil"></i> Modificar', ['view', 'id'=>$model->PRO_ID],['class'=>'btn btn-default text-blue btn-flat btn-sm']);
                    },
                ],
            ],
        ],
        'tableOptions' =>['class' => 'table table-striped table-bordered'],
    ]); ?>

</div>
</div>
