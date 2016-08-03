<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReportesAvancesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Reportes de Avances';
$this->params['breadcrumbs'][] = ['label' => 'Ordenes de Trabajos', 'url' => ['orden-trabajo/index']];
$this->params['breadcrumbs'][] = [
                    'label' => $ordentrabajo->OT_NOMBRE,
                    //'url' => ['orden-trabajo/index'],
                    'style'=> 'color:white',
                    'template' => "<button class='btn btn-flat btn-sm' style='background-color : #333D43; color:white; float:right; margin-left: 4px;'>{link}</button>\n"
                ];
$this->params['breadcrumbs'][] = 'Reportes de avances';

?>
<div class="reportes-avances-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


<?php 
    Modal::begin([
            'header'=>'<h4>Reporte de Avances</h4>',
            'id'=>'modal-view-tn',
            'size'=>'modal-tn',
        ]);
    echo "<div class='modalContent'></div>";
    Modal::end();
 ?>

<?php 
    Modal::begin([
            'header'=>'<h4>Reporte de Avances</h4>',
            'id'=>'modal',
            'size'=>'modal-lg',
        ]);
    echo "<div class='modalContent'></div>";
    Modal::end();
 ?>

    <h1>Reportes de Avances</h1>

<br>

<div class="row">
    <div class="col-md-3">
            <?= Html::a('Ingresar Reporte de avances', ['reportes-avances/create','id' => $ordentrabajo->PRO_ID], ['class' => 'btn btn-primary btn-block btn-flat margin-bottom',]) ?>
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Orden de Trabajo</h3>
            </div>
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <?php /*<li class="view" id="<?php echo $model->PRO_ID; ?>"><a href="#"><i class="fa fa-tasks"></i> <span style="padding-left:5px">InformaciÃ³n</span></a></li>*/ ?>
                    <li><?= Html::a('<i class="fa fa-tasks"></i> Actividades', ['orden-trabajo/index-actividades', 'id'=>$ordentrabajo->OT_ID]) ?></li>
                    <li><?= Html::a('<i class="fa fa-file-excel-o"></i> Estados de Pagos', ['orden-trabajo/index-estado-pago', 'id'=>$ordentrabajo->OT_ID]) ?></li>
                    <li class="active"><a href="#"><i class="fa fa-inbox"></i> Reportes de Avances</a></li>
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
            <div class="box-body no-padding">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'summary'=>'',
                    //'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        //'RA_ID',
                        'RA_TITULO',
                        [
                            'attribute'=>'OT_ID',
                            'value'=>'oT.OT_NOMBRE',
                        ],
                        'RA_DESCRIPCION:ntext',
                        'RA_FECHA:date',
                        // 'RA_TEXTO:ntext',

                        ['class' => 'yii\grid\ActionColumn',
                            'template'=>'{ver}',
                            'buttons' => [
                                'ver' => function ($url,$model) {
                                    return Html::button('<i class="fa fa-eye"></i> Ver Reporte', ['value'=>Url::to(['view-modal','id'=>$model->RA_ID]), 'class'=>'btn btn-default text-blue btn-flat btn-sm modalViewTn']);
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
