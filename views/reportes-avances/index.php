<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReportesAvancesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

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

            <?= Html::button('Ingresar Reporte de avances', ['value'=>Url::to(['reportes-avances/create','id'=>$ordentrabajo->OT_ID]),'class'=> 'btn btn-flat btn-success margin-bottom','id'=>'modalButton']) ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'RA_ID',
                    //'oT.OT_NOMBRE',
                    'RA_TITULO',
                    'RA_DESCRIPCION:ntext',
                    'RA_FECHA:date',
                    // 'RA_TEXTO:ntext',

                    //['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>


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
