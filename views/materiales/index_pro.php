<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use app\models\BoMatAlmacena;
use app\models\StockMateriales;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MaterialesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $ordentrabajo->OT_NOMBRE;
$this->params['breadcrumbs'][] = ['label' => $ordentrabajo->OT_NOMBRE, 'url' => ['ordentrabajo/index']];
$this->params['breadcrumbs'][] = 'Materiales';
?>
<div class="materiales-index">

    <h1>Materiales</h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


<?php /*
        <?= Html::button('Ingresar Orden de Compra',['value'=>Url::to(['ingresar-adquisiciones','id'=>$proyecto->PRO_ID]),'class'=>'btn btn-flat btn-primary btn-block margin-bottom modalView']) ?>

            <?= Html::button('Crear Orden de Despacho', ['value'=>Url::to(['crear-despacho-mat','id'=>$proyecto->PRO_ID]),'class'=> 'btn btn-warning btn-block margin-bottom btn-flat botonmodal modalView']) ?>
*/ ?>

<?php 
    Modal::begin([
            'header'=>'<h4>Orden de Compra</h4>',
            'id'=>'modal',
            'size'=>'modal-lg',
        ]);
    echo "<div class='modalContent'></div>";
    Modal::end();
 ?>

<?php 
    Modal::begin([
            'header'=>'<h4>Material</h4>',
            'id'=>'modal-view',
            'size'=>'modal-lg',
        ]);
    echo "<div class='modalContent'></div>";
    Modal::end();
 ?>

<br>

<div class="row">
    <div class="col-md-3">
        <?= Html::a('Ingresar Orden de Compra',['materiales/ingresar-adquisiciones','id'=>$ordentrabajo->PRO_ID],['class'=>'btn btn-flat btn-primary btn-block margin-bottom']) ?>
        <?= Html::a('Ingresar Orden de Despacho',['materiales/crear-despacho-mat','id'=>$ordentrabajo->PRO_ID],['class'=>'btn btn-flat btn-success btn-block margin-bottom']) ?>
        <div class="otbutton">
        </div>

        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Orden de Trabajo</h3>
            </div>
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <?php /*<li class="view" id="<?php echo $model->PRO_ID; ?>"><a href="#"><i class="fa fa-tasks"></i> <span style="padding-left:5px">InformaciÃ³n</span></a></li>*/ ?>
                    <li><?= Html::a('<i class="fa fa-tasks"></i> Actividades', ['orden-trabajo/index-actividades', 'id'=>$ordentrabajo->OT_ID]) ?></li>
                    <li><?= Html::a('<i class="fa fa-file-excel-o"></i> Estados de Pagos', ['orden-trabajo/index-estado-pago', 'id'=>$ordentrabajo->OT_ID]) ?></li>
                    <li><?= Html::a('<i class="fa fa-inbox"></i> Reportes de Avances', ['orden-trabajo/index-reportes-avances', 'id'=>$ordentrabajo->OT_ID]) ?></li>
                    <li><?= Html::a('<i class="glyphicon glyphicon-usd"></i> Gastos Generales', ['orden-trabajo/index-gastos-generales', 'id'=>$ordentrabajo->OT_ID]) ?></li>
                    <li class="active"><a href="#"><i class="glyphicon glyphicon-list-alt"></i> Materiales</a></li>
                    <li><?= Html::a('<i class="fa fa-bar-chart"></i> Gráfico', ['orden-trabajo/grafico-ot', 'id'=>$ordentrabajo->OT_ID]) ?></li>
                    <li><?= Html::a('<i class="glyphicon glyphicon-file"></i> Informes', ['proyecto/informes-pro', 'id'=>$ordentrabajo->PRO_ID]) ?></li>
                </ul>
            </div>
        </div>

    </div>

    <div class="col-md-9">
        <div class="box box-solid">

            <dic class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><?= Html::a('Stock',['orden-trabajo/index-materiales', 'id'=>$ordentrabajo->PRO_ID]) ?></li>
                    <li><a href="asd" data-toggle="tab" aria-expanded="false" id="bodega">Bodega</a></li>
                    <?php /*<li><a href="" data-toggle="tab" aria-expanded="false" id="adquisicion">Adquisiciones</a></li>*/ ?>
                    <li><a href="" data-toggle="tab" aria-expanded="false" id="movimientos">Movimientos</a></li>
                    <li><a href="" data-toggle="tab" aria-expanded="false" id="pedidos">Pedidos</a></li>
                    <li><a href="" data-toggle="tab" aria-expanded="false" id="orden-compra">Ordenes de Compra</a></li>
                    <li><a href="" data-toggle="tab" aria-expanded="false" id="orden-despacho">Ordenes de Despacho</a></li>
                </ul>
                <div class="tab-content">
                    <br>
                    <div id="contenido">
                        <?= $this->render('../materiales/index_info', [
                                            'dataProvider' => $dataProvider,
                                            'searchModel' => $searchModel,
                        ]) ?>
                    </div>
                </div>
            </dic>


        </div>
    </div>
</div>


</div>

<?php 
$script = <<< JS
    $('#adquisicion').click(function(){
        var id= $ordentrabajo->PRO_ID;
        $.get('index.php?r=materiales/adquisicion-pro',{ id : id }, function(data){
            $('#contenido').empty();
            $('#contenido').append(data);
        })
    });
    $('#movimientos').click(function(){
        var id= $ordentrabajo->PRO_ID;
        $.get('index.php?r=materiales/movimientos-pro',{ id : id }, function(data){
            $('#contenido').empty();
            $('#contenido').append(data);
        })
    });
    $('#bodega').click(function(){
        var id= $ordentrabajo->PRO_ID;
        $.get('index.php?r=materiales/bodega-pro',{ id : id }, function(data){
            $('#contenido').empty();
            $('#contenido').append(data);
        })
    });
    $('#pedidos').click(function(){
        var id= $ordentrabajo->PRO_ID;
        $.get('index.php?r=materiales/pedidos-pro',{ id : id }, function(data){
            $('#contenido').empty();
            $('#contenido').append(data);
        })
    });
    $('#avances').click(function(){
        var id= $('.idorden').attr('idot');
        $.get('index.php?r=reportes-avances/index',{ id : id }, function(data){
            $('#contenido').empty();
            $('#contenido').append(data);
        })
    });
    $('#orden-compra').click(function(){
        var id= $ordentrabajo->PRO_ID;
        $.get('index.php?r=materiales/index-oc',{ id : id }, function(data){
            $('#contenido').empty();
            $('#contenido').append(data);
        })
    });
    $('#orden-despacho').click(function(){
        var id= $ordentrabajo->PRO_ID;
        $.get('index.php?r=materiales/index-od',{ id : id }, function(data){
            $('#contenido').empty();
            $('#contenido').append(data);
        })
    });
JS;
$this->registerJs($script);
?>
