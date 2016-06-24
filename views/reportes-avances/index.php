<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReportesAvancesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = $proyecto->PRO_NOMBRE;
$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Reportes de avances';

?>
<div class="reportes-avances-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


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
            <?= Html::button('Ingresar Reporte de avances', ['value'=>Url::to(['reportes-avances/create','id' => $proyecto->PRO_ID]), 'class' => 'btn btn-success btn-block btn-flat margin-bottom','id'=>'modalButton']) ?>
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Proyecto</h3>
            </div>
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <?php /*<li class="view" id="<?php echo $model->PRO_ID; ?>"><a href="#"><i class="fa fa-tasks"></i> <span style="padding-left:5px">InformaciÃ³n</span></a></li>*/ ?>
                    <li><?= Html::a('<i class="fa fa-eye"></i> Detalles', ['proyecto/view', 'id'=>$proyecto->PRO_ID]) ?></li>
                    <li><?= Html::a('<i class="fa fa-tasks"></i> Ordenes de Trabajos', ['orden-trabajo/indexpro', 'id'=>$proyecto->PRO_ID]) ?></li>
                    <li><?= Html::a('<i class="fa fa-file-excel-o"></i> Estados de Pagos', ['estado-pago/index', 'id'=>$proyecto->PRO_ID]) ?></li>
                    <li class="active"><a href="#"><i class="fa fa-inbox"></i> Reportes de Avances</a></li>
                    <li><?= Html::a('<i class="glyphicon glyphicon-usd"></i> Gastos Generales', ['gastos-generales/index', 'id'=>$proyecto->PRO_ID]) ?></li>
                    <li><?= Html::a('<i class="glyphicon glyphicon-list-alt"></i> Materiales', ['materiales/materiales-pro', 'id'=>$proyecto->PRO_ID]) ?></li>
                    <li><?= Html::a('<i class="glyphicon glyphicon-file"></i> Informes', ['informes-pro', 'id'=>$proyecto->PRO_ID]) ?></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-body no-padding">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
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

                        //['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
            </div>
        </div>

    </div>

</div>




    <?php /*
<div class="row">


    <div class="col-md-3">
        <div class="box box-solid">
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <li><?= Html::a('Actividades', ['actividades/index', 'id'=>$ordentrabajo->OT_ID]) ?></li>
                     <li><?= Html::a('Calendario de Actividades', ['actividades/calendario', 'id'=>$ordentrabajo->OT_ID]) ?></li>
                    <li class="active"><a href="#">Reportes de avances</a></li>
                    <li><?= Html::a('Movimientos de Materiales', ['orden-trabajo/transaccion', 'id'=>$ordentrabajo->OT_ID]) ?></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-9">    


            <ul class="timeline">
            <?php if ($reportes!=NULL) { ?>
                <?php foreach ($reportes as $avances) { ?>
                    <li class="time-label">
                        <span class="bg-blue">
                            <?= $avances->RA_FECHA ?>
                        </span>
                        <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>
                            <h3 class="timeline-header"><a href="#"><?= $avances->RA_TITULO ?></a> ...</h3>
                            <div class="timeline-body">
                              <?= $avances->RA_DESCRIPCION ?>
                            </div>
                            <div class="timeline-footer">
                                <a class="btn btn-primary btn-xs">...</a>
                            </div>
                        </div>
                    </li>
                <?php } ?>
            <?php }else{ ?>
                <li class="time-label">
                    <span class="bg-yellow">No existen reportes de avances para este proyecto</span>
                </li>

            <?php } ?>
            <li class="time-label">
                <i class="fa fa-clock-o bg-gray"></i>
            </li>

            </ul>
    </div>
</div>
    */ ?>
</div>
