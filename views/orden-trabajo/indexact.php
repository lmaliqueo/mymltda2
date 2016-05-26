<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ActividadesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $ordentrabajo->OT_NOMBRE;
$this->params['breadcrumbs'][] = ['label' => $ordentrabajo->pRO->PRO_NOMBRE, 'url' => ['proyecto/view', 'id'=>$ordentrabajo->PRO_ID]];
$this->params['breadcrumbs'][] = ['label' => $ordentrabajo->OT_NOMBRE, 'url' => ['orden-trabajo/indexpro', 'id'=>$ordentrabajo->PRO_ID]];
$this->params['breadcrumbs'][] = 'Actividades';
?>
<div class="actividades-index">
<?php /*
    <h1>Actividades</h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?php 
    Modal::begin([
            'header'=>'<h4>Actividades</h4>',
            'id'=>'modal',
            'size'=>'modal-lg',
        ]);
    echo "<div class='modalContent'></div>";
    Modal::end();
 ?>


<br>

<div class="row">
    <div class="col-md-3">
            <?= Html::button('<span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Crear Actividad', ['value'=>Url::to(['actividades/crear','ot'=>$ordentrabajo->OT_ID]),'class'=> 'btn btn-success btn-block margin-bottom','id'=>'modalButton']) ?>
        <div class="box box-solid">
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href="#">Actividades</a></li>
                    <li><?= Html::a('Calendario de Actividades', ['actividades/calendario', 'id'=>$ordentrabajo->PRO_ID]) ?></li>
                     <li><?= Html::a('Reportes de Avances', ['reportes-avances/index', 'id'=>$ordentrabajo->OT_ID]) ?></li>
                    <li><?= Html::a('Movimientos de Materiales', ['orden-trabajo/transaccion', 'id'=>$ordentrabajo->OT_ID]) ?></li>
               </ul>
            </div>
        </div>
    </div>

    <div class="col-md-9">
    </div>
</div>
</div>
*/ ?>
        <div class="box box-solid">

            <dic class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li><a href="" data-toggle="tab" aria-expanded="false" id="obreros">Info. General</a></li>
                    <li><a href="" data-toggle="tab" aria-expanded="false" id="recursos">Recursos</a></li>
                    <li><a href="" data-toggle="tab" aria-expanded="false" id="calendario">Calendario</a></li>
                    <li class="active"><a href="" data-toggle="tab" aria-expanded="true" id="index">Actividades</a></li>
                    <li id="otid" class="pull-left header idorden" idot="<?php echo $ordentrabajo->OT_ID; ?>">  <i class="fa fa-arrow-circle-left text-blue"></i><strong>OT:</strong> <?= $ordentrabajo->OT_NOMBRE ?></li>
                </ul>
                <div class="tab-content" id="contenido">
                            <?= Html::a('Crear Actividades', ['actividades/crear-calendario', 'id' => $ordentrabajo->OT_ID], ['class' => 'btn btn-primary btn-flat margin-bottom']) ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
    'summary'=>'',
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'AC_NOMBRE',
                            'AC_FECHA_INICIO',
                            'AC_FECHA_TERMINO',
                            'AC_COSTO_TOTAL',
                            'AC_ESTADO',

                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                </div>
            </dic>


        </div>

<?php 
$script = <<< JS
    $('#calendario').click(function(){
        var id= $('.idorden').attr('idot');
        $.get('index.php?r=actividades/calendario',{ id : id }, function(data){
            $('#contenido').empty();
            $('#contenido').append(data);
        })
    });
    $('#index').click(function(){
        var id= $('.idorden').attr('idot');
        $.get('index.php?r=actividades/index',{ id : id }, function(data){
            $('#contenido').empty();
            $('#contenido').append(data);
        })
    });
    $('#recursos').click(function(){
        var id= $('.idorden').attr('idot');
        $.get('index.php?r=orden-trabajo/transaccion',{ id : id }, function(data){
            $('#contenido').empty();
            $('#contenido').append(data);
        })
    });
    $('#obreros').click(function(){
        var id= $('.idorden').attr('idot');
        $.get('index.php?r=actividades/calendario',{ id : id }, function(data){
            $('#contenido').empty();
            $('#contenido').append(data);
        })
    });
JS;
$this->registerJs($script);
?>
