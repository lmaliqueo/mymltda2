<?php

use yii\helpers\Html;
use yii\helpers\Url;
//use kartik\grid\GridView;
use app\models\Actividades;
use app\models\StockMateriales;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrdenTrabajoTrabajo */
/* @var $dataProvider yii\data\ActiveDataProvider */

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

        <h1>
            <?php if ($contenido=='ot') {
                echo 'Ordenes de Trabajos';
            }else{
                echo 'Orden de Trabajo';
            } ?>
            
        </h1>
        <br>

<div class="row">
    <div class="col-md-3">
        <div class="otbutton">
            <?php 
            if($contenido=='ot'){
                echo Html::button('Crear Orden de Trabajo', ['value'=>Url::to(['orden-trabajo/create','pro'=>$proyecto->PRO_ID]),'class'=> 'btn btn-success btn-block margin-bottom botonmodal','id'=>'modalButton']); 
            }else{
                echo Html::a('Crear Actividades', ['actividades/crear-calendario', 'id' => $ordentrabajo->OT_ID], ['class' => 'btn btn-primary btn-flat btn-block margin-bottom']);
            } ?>
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
                    <li><?= Html::a('<i class="fa fa-inbox"></i> Reportes de Avances', ['reportes-avances/index', 'id'=>$proyecto->PRO_ID]) ?></li>
                    <li><?= Html::a('<i class="glyphicon glyphicon-usd"></i> Gastos Generales', ['gastos-generales/index', 'id'=>$proyecto->PRO_ID]) ?></li>
                    <li><?= Html::a('<i class="glyphicon glyphicon-list-alt"></i> Materiales', ['materiales/materiales-pro', 'id'=>$proyecto->PRO_ID]) ?></li>
                    <li><?= Html::a('<i class="glyphicon glyphicon-file"></i> Informes', ['proyecto/informes-pro', 'id'=>$proyecto->PRO_ID]) ?></li>
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

<?php if ($contenido=='ot') {
    echo $this->render('indexot', [
        'dataProvider' => $dataProvider,
        'searchModel' => $searchModel,
        'proyecto' => $proyecto,
    ]);
}else{
    echo $this->render('indexact', [
        'dataProvider' => $dataProvider,
        'searchModel' => $searchModel,
        'ordentrabajo' => $ordentrabajo,
    ]);
} ?>


</div>
</div>
</div>


