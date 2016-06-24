<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrdenTrabajoTrabajo */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = $proyecto->PRO_NOMBRE;
$this->params['breadcrumbs'][] = ['label' => $proyecto->PRO_NOMBRE, 'url' => ['proyecto/view', 'id'=>$proyecto->PRO_ID]];
$this->params['breadcrumbs'][] = 'Ordenes de Trabajos';
?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



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
                        return Html::a($data->OT_NOMBRE, ['orden-trabajo/index-act','id'=>$data->OT_ID], ['class'=>'text-muted orden', 'idot'=>$data->OT_ID]);
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
