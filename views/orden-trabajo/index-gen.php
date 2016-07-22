<?php

use yii\helpers\Html;
use yii\helpers\Url;
//use kartik\grid\GridView;
use yii\bootstrap\Modal;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrdenTrabajoTrabajo */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title='Ordenes de Trabajos';
?>
<div class="orden-trabajo-index">

    <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>


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

<p>
        <?= Html::button('Generar Orden de Trabajo', ['value'=>Url::to(['orden-trabajo/crear-ot']),'class'=> 'btn btn-success btn-flat','id'=>'modalButton']) ?>
</p>


        <div class="box box-primary">
            <div class="box-body no-padding">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'summary'=>'',
                    //'filterModel' => $searchModel,
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
                    'label'=>'OT',
                    'attribute'=>'OT_NOMBRE',
                    'format'=>'raw',
                    'value' => function($data){
                        //return Html::a($data->OT_NOMBRE, ['orden-trabajo/index-act','id'=>$data->OT_ID], ['class'=>'text-muted orden', 'idot'=>$data->OT_ID]);
                        return '<strong>'.$data->OT_NOMBRE.'</strong>';
                    }
                ],
                [
                    //'label'=>'N',
                    'attribute'=>'PRO_ID',
                    'format'=>'raw',
                    'value' => 'pRO.PRO_NOMBRE'
                ],
                [
                    'label'=>'Cliente',
                    'attribute'=>'PRO_ID',
                    'format'=>'raw',
                    'value' => 'pRO.eMPRUT.EMP_RAZON'
                ],
                        //'OT_TIPO',
                        'OT_FECHA_INICIO:date',
                        'OT_FECHA_TERMINO:date',
                            [
                                //'label'=>'N',
                                'attribute'=>'OT_ESTADO',
                                'format'=>'raw',
                                'value' => function($data){
                                    return '<span class="label label-primary">'.$data->OT_ESTADO.'</span>';
                                }
                            ],
                        //'OT_ESTADO',
                        'OT_COSTO_TOTAL',
                        // 'OT_INFORME',
                        ['class' => 'yii\grid\ActionColumn',
                            'template'=>'{ver} {actualizar}',
                            'buttons' => [
                                'ver' => function ($url,$model) {
                                    return Html::a('Ver Orden de Trabajo', ['orden-trabajo/index-actividades','id'=>$model->OT_ID], ['class'=>'btn btn-flat btn-warning btn-sm orden', 'idot'=>$model->OT_ID]);
                                },
                                'actualizar' => function ($url,$model) {
                                    if ($model->OT_ESTADO!='Finalizado') {
                                        return Html::button('Actualizar', ['value'=>Url::to(['update','id'=>$model->OT_ID]), 'class'=>'btn btn-flat btn-primary btn-sm orden', 'id'=>'modalButton']);
                                    }
                                },
                            ],
                        ],

                    ],
                'tableOptions' =>['class' => 'table table-striped table-bordered'],
                ]); ?>
            </div>
        </div>



</div>


