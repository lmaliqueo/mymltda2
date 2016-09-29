<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ActividadesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Actividades';
$this->params['breadcrumbs'][] = [
                    'label' => 'Ordenes de Trabajos',
                    'url' => ['orden-trabajo/index'],
                    //'style'=> 'color:333D43',
                    //'template' => "<li>{link}</li>\n"
                ];
$this->params['breadcrumbs'][] = [
                    'label' => $ordentrabajo->OT_NOMBRE,
                    //'url' => ['orden-trabajo/index'],
                    'style'=> 'color:white',
                    'template' => "<button class='btn btn-flat btn-sm' style='background-color : #333D43; color:white; float:right; margin-left: 4px;'>{link}</button>\n"
                ];
$this->params['breadcrumbs'][] = 'Actividades';
?>
<div class="orden-trabajo-index">
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
                <ul class="nav nav-tabs">
                    <li class="active"><?= Html::a('Actividades',['orden-trabajo/index-actividades', 'id'=>$ordentrabajo->PRO_ID]) ?></li>
                    <li><a href="" data-toggle="tab" aria-expanded="false" id="calendario">Calendario</a></li>
                    <?php /*<li><a href="" data-toggle="tab" aria-expanded="false" id="inf_general">Grafico</a></li>*/ ?>
                    <?php /*<li><a href="" data-toggle="tab" aria-expanded="false" id="recursos">Recursos</a></li>*/ ?>
                </ul>
                <div class="tab-content" id="contenido">
                    <?= $this->render('index', [
                                        'dataProvider' => $dataProvider,
                                        'searchModel' => $searchModel,
                                        'ordentrabajo' => $ordentrabajo,
                    ]) ?>
                </div>
            </dic>


        </div>
        </div>

<?php 
$script = <<< JS
    $('#calendario').click(function(){
        var id= $ordentrabajo->OT_ID;
        $.get('../actividades/calendario',{ id : id }, function(data){
            $('#contenido').empty();
            $('#contenido').append(data);
        })
    });
    $('#index').click(function(){
        var id= $ordentrabajo->OT_ID;
        $.get('../actividades/index',{ id : id }, function(data){
            $('#contenido').empty();
            $('#contenido').append(data);
        })
    });
    $('#recursos').click(function(){
        var id= $ordentrabajo->OT_ID;
        $.get('orden-trabajo/transaccion',{ id : id }, function(data){
            $('#contenido').empty();
            $('#contenido').append(data);
        })
    });
    $('#inf_general').click(function(){
        var id= $ordentrabajo->OT_ID;
        $.get('orden-trabajo/info-general',{ id : id }, function(data){
            $('#contenido').empty();
            $('#contenido').append(data);
        })
    });
JS;
$this->registerJs($script);
?>
