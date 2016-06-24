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

$this->title = $proyecto->PRO_NOMBRE;
$this->params['breadcrumbs'][] = ['label' => $proyecto->PRO_NOMBRE, 'url' => ['proyecto/view', 'id'=>$proyecto->PRO_ID]];
$this->params['breadcrumbs'][] = 'Materiales';
?>
<div class="materiales-index">

    <h1>Materiales</h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
   </p>
<?php 
    Modal::begin([
            'header'=>'<h4>Nuevo Material</h4>',
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
        <div class="otbutton">
            <?= Html::button('Ingresar Material', ['value'=>Url::to(['crear-transaccion','id'=>$proyecto->PRO_ID]),'class'=> 'btn btn-success btn-block margin-bottom botonmodal','id'=>'modalButton']) ?>
        </div>

        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Proyecto</h3>
            </div>
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <li><?= Html::a('<i class="fa fa-eye"></i> Detalles', ['proyecto/view', 'id'=>$proyecto->PRO_ID]) ?></li>
                    <?php /*<li class="view" id="<?php echo $model->PRO_ID; ?>"><a href="#"><i class="fa fa-tasks"></i> <span style="padding-left:5px">InformaciÃ³n</span></a></li>*/ ?>
                    <li><?= Html::a('<i class="fa fa-tasks"></i> Ordenes de Trabajos', ['orden-trabajo/indexpro', 'id'=>$proyecto->PRO_ID]) ?></li>
                    <li><?= Html::a('<i class="fa fa-file-excel-o"></i> Estados de Pagos', ['estado-pago/index', 'id'=>$proyecto->PRO_ID]) ?></li>
                    <li><?= Html::a('<i class="fa fa-inbox"></i> Reportes de Avances', ['reportes-avances/index', 'id'=>$proyecto->PRO_ID]) ?></li>
                    <li><?= Html::a('<i class="glyphicon glyphicon-usd"></i> Gastos Generales', ['gastos-generales/index', 'id'=>$proyecto->PRO_ID]) ?></li>
                    <li class="active"><a href="#"><i class="glyphicon glyphicon-list-alt"></i> Materiales</a></li>
                    <li><?= Html::a('<i class="glyphicon glyphicon-file"></i> Informes', ['proyecto/informes-pro', 'id'=>$proyecto->PRO_ID]) ?></li>
                </ul>
            </div>
        </div>

    </div>

    <div class="col-md-9">
        <div class="box box-solid">

            <dic class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><?= Html::a('Stock',['materiales-pro', 'id'=>$proyecto->PRO_ID]) ?></li>
                    <li><a href="" data-toggle="tab" aria-expanded="false" id="transacciones">Transacciones</a></li>
                    <li><a href="" data-toggle="tab" aria-expanded="false" id="movimientos">Movimientos</a></li>
                    <li><a href="asd" data-toggle="tab" aria-expanded="false" id="bodega">Bodega</a></li>
                    <li><a href="" data-toggle="tab" aria-expanded="false" id="pedidos">Pedidos</a></li>
                </ul>
                <div class="tab-content" id="contenido">
                    <?= $this->render('index_info', [
                                        'dataProvider' => $dataProvider,
                                        'searchModel' => $searchModel,
                    ]) ?>
                </div>
            </dic>


        </div>
    </div>
</div>


</div>

<?php 
$script = <<< JS
    $('#transacciones').click(function(){
        var id= $proyecto->PRO_ID;
        $.get('index.php?r=materiales/transacciones-pro',{ id : id }, function(data){
            $('#contenido').empty();
            $('#contenido').append(data);
        })
    });
    $('#movimientos').click(function(){
        var id= $proyecto->PRO_ID;
        $.get('index.php?r=materiales/movimientos-pro',{ id : id }, function(data){
            $('#contenido').empty();
            $('#contenido').append(data);
        })
    });
    $('#bodega').click(function(){
        var id= $proyecto->PRO_ID;
        $.get('index.php?r=materiales/bodega-pro',{ id : id }, function(data){
            $('#contenido').empty();
            $('#contenido').append(data);
        })
    });
    $('#pedidos').click(function(){
        var id= $proyecto->PRO_ID;
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
JS;
$this->registerJs($script);
?>
