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

        <h1>Actividades</h1>
        <br>

<div class="row">
    <div class="col-md-3">
        <div class="otbutton">
            <?= Html::a('Crear Actividades', ['actividades/crear-calendario', 'id' => $ordentrabajo->OT_ID], ['class' => 'btn btn-primary btn-flat btn-block margin-bottom']) ?>
        </div>

        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Orden de Trabajo</h3>
            </div>
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <?php /*<li class="view" id="<?php echo $model->PRO_ID; ?>"><a href="#"><i class="fa fa-tasks"></i> <span style="padding-left:5px">InformaciÃ³n</span></a></li>*/ ?>
                    <li class="active"><a href="#"><i class="fa fa-tasks"></i> Actividades</a></li>
                    <li><?= Html::a('<i class="fa fa-file-excel-o"></i> Estados de Pagos', ['orden-trabajo/index-estado-pago', 'id'=>$ordentrabajo->OT_ID]) ?></li>
                    <li><?= Html::a('<i class="fa fa-inbox"></i> Reportes de Avances', ['orden-trabajo/index-reportes-avances', 'id'=>$ordentrabajo->OT_ID]) ?></li>
                    <li><?= Html::a('<i class="glyphicon glyphicon-usd"></i> Gastos Generales', ['orden-trabajo/index-gastos-generales', 'id'=>$ordentrabajo->OT_ID]) ?></li>
                    <li><?= Html::a('<i class="glyphicon glyphicon-list-alt"></i> Materiales', ['orden-trabajo/index-materiales', 'id'=>$ordentrabajo->OT_ID]) ?></li>
                    <li><?= Html::a('<i class="fa fa-line-chart"></i> Gráfico', ['orden-trabajo/grafico-ot', 'id'=>$ordentrabajo->OT_ID]) ?></li>
                    <li><?= Html::a('<i class="glyphicon glyphicon-file"></i> Informes', ['proyecto/informes-pro', 'id'=>$ordentrabajo->PRO_ID]) ?></li>
                </ul>
            </div>
        </div>

    </div>




    <div class="col-md-9">

<?= $this->render('indexact', [
        'dataProvider' => $dataProvider,
        'searchModel' => $searchModel,
        'ordentrabajo' => $ordentrabajo,
    ]) ?>


</div>
</div>
</div>


