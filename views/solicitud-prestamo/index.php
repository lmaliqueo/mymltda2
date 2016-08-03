<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\SpreHeSolicita;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SolicitudPrestamoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Solicitud Prestamos';
$this->params['breadcrumbs'][] = [
                    'label' => 'Herramientas',
                    'url' => ['herramientas/index'],
                    //'style'=> 'color:333D43',
                    //'template' => "<li>{link}</li>\n"
                ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="solicitud-prestamo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



<br>









<div class="row">
    <div class="col-md-3">
            <?= Html::a('Create Solicitud Prestamo', ['create'], ['class' => 'btn btn-success btn-block btn-flat margin-bottom']) ?>
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Operaciones</h3>
            </div>
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <li><?= Html::a('<i class="fa fa-angle-right"></i> Lista herramientas', ['herramientas/index']) ?></li>
                    <li><?= Html::a('<i class="fa fa-angle-right"></i> Despacho de herramientas', ['herramientas/despachos-index']) ?></li>
                    <li><?= Html::a('<i class="fa fa-angle-right"></i> Devolución de herramientas', ['herramientas/retorno-index']) ?></li>
                    <li class="active"><a href="#"><i class="fa fa-angle-right"></i> Solicitud de Prestamo</a></li>
                </ul>
            </div>
        </div>
    </div>




    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-body no-padding">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    //'filterModel' => $searchModel,
                    'summary'=>'',
                    'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                        /*[                'class' => 'kartik\grid\ExpandRowColumn',
                            'value' => function ($model, $key, $index, $column){
                                return GridView::ROW_COLLAPSED;
                            },
                            'detail' => function ($model, $key, $index, $column){
                                $solicita= SpreHeSolicita::find()->where(['SPRE_ID'=>$model->SPRE_ID])->all();

                                return Yii::$app->controller->renderPartial('expandspre', [
                                        'solicita' => $solicita,
                                        'model' => $model,
                                    ]);
                            },
                        ],*/

                        //'SPRE_ID',
                        'PE_RUT',
                        'SPRE_TITULO',
                        'SPRE_FECHA',
                        'SPRE_ESTADO',
                        // 'SPRE_TEXTO:ntext',

                        ['class' => 'yii\grid\ActionColumn',
                            'template' => '{aprobar} {view} {update} {delete}',
                            'buttons' => [
                            'aprobar' => function ($url, $model, $key) { // <--- here you can override or create template for a button of a given name
                                 return Html::a('<span class="glyphicon glyphicon glyphicon-ok" aria-hidden="true"></span>', ['solicitud-prestamo/aprobar', 'id' => $model->SPRE_ID]);
                            },
                        ],
                        ],
                    ],
                ]); ?>

            </div>

        </div>
    </div>
</div>

</div>
