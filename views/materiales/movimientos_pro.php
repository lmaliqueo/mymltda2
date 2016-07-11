<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use app\models\BoMatAlmacena;
use app\models\StockMateriales;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;
use dosamigos\datepicker\DateRangePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MaterialesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Materiales';
$this->params['breadcrumbs'][] = $this->title;
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


<div class="box box-default box-solid collapsed-box">
    <div class="box-header whit-border">
        <h4 class="box-title"><span class="glyphicon glyphicon-search"></span> Buscar</h4>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-plus"></i>
            </button>
        </div>
    </div>
    <div class="box-body" style="display: none;">
        <div class="row margin-bottom">
            <div class="col-xs-3">
                <label class="control-label pull-right">
                    Orden de Trabajo
                </label>
            </div>
            <div class="col-xs-9">
                <?php 
                echo Select2::widget([
                    'name' => 'ot',
                    'value' => 'OT_ID',
                    'data' => ArrayHelper::map($orden_trabajo,'OT_ID','OT_NOMBRE','OT_ESTADO'),
                    'options' => ['placeholder' => 'Buscar por OT', 'id'=>'id_ot',
                                /*'onchange'=>'$.post("index.php?r=materiales/lista-materiales&id='.'"+$(this).val(),function(data){
                                    $("select.idmat").html(data);
                                } )',*/],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                 ?>
            </div>
        </div>
        <div class="row margin-bottom">
            <div class="col-xs-3">
                <label class="control-label pull-right">
                    Material
                </label>
            </div>
            <div class="col-xs-9">
                <?php 
                echo Select2::widget([
                    'name' => 'materiales',
                    'value' => 'MA_ID',
                    'data' => ArrayHelper::map($materiales,'MA_ID','MA_NOMBRE','tMA.TMA_NOMBRE'),
                    'options' => ['placeholder' => 'Buscar por Material', 'id'=>'id_material',
                                /*'onchange'=>'$.post("index.php?r=materiales/lista-materiales&id='.'"+$(this).val(),function(data){
                                    $("select.idmat").html(data);
                                } )',*/],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                 ?>
            </div>
        </div>
        <div class="margin-bottom">
            <div class="col-xs-3">
                <label class="control-label pull-right">
                    Fecha
                </label>
            </div>
            <div class="col-xs-9">
                <?= DateRangePicker::widget([
                    'name' => 'date_from',
                    'value' => $proyecto->PRO_FECHA_INICIO,
                    'id'=>'fecha_inicio',
                    'nameTo' => 'name_to',
                    'valueTo' => date('Y-m-d'),
                    'optionsTo' => ['id'=>'fecha_final',
                                /*'onchange'=>'$.post("index.php?r=materiales/lista-materiales&id='.'"+$(this).val(),function(data){
                                    $("select.idmat").html(data);
                                } )',*/],
                    'language' => 'es',
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true,
                        'startDate' => $proyecto->PRO_FECHA_INICIO,
                        'endDate' => date('Y-m-d')
                    ]
                ]);?>
            </div>
        </div>
    </div>
</div>

<div id="content_mov">
    <?= $this->render('tabla_mov_mat', [
        'adquiridos' => $adquiridos,
        'utilizados' => $utilizados,
    ]) ?>
</div>



<?php 
$script = <<< JS

    $('#id_material').change(function(){
        var fecha_ini = $('#fecha_inicio').val();
        var fecha_fin = $('#fecha_final').val();
        var idpro= $proyecto->PRO_ID;
        var idmat = $(this).val();
        var idot = $('#id_ot').val();
            $.get('index.php?r=materiales/buscar-mov-mat',{ idpro : idpro, idmat : idmat, idot : idot, fecha_f : fecha_fin, fecha_i : fecha_ini }, function(data){
                $('#content_mov').empty();
                $('#content_mov').append(data);
            })
    });
    $('#id_ot').change(function(){
        var fecha_ini = $('#fecha_inicio').val();
        var fecha_fin = $('#fecha_final').val();
        var idpro= $proyecto->PRO_ID;
        var idot = $(this).val();
        var idmat = $('#id_material').val();
            $.get('index.php?r=materiales/buscar-mov-mat',{ idpro : idpro, idmat : idmat, idot : idot, fecha_f : fecha_fin, fecha_i : fecha_ini }, function(data){
                $('#content_mov').empty();
                $('#content_mov').append(data);
            })
    });
    $('#fecha_inicio').change(function(){
        var fecha_ini = $(this).val();
        var fecha_fin = $('#fecha_final').val();
        var idpro= $proyecto->PRO_ID;
        var idot = $('#id_ot').val();
        var idmat = $('#id_material').val();
            $.get('index.php?r=materiales/buscar-mov-mat',{ idpro : idpro, idmat : idmat, idot : idot, fecha_f : fecha_fin, fecha_i : fecha_ini }, function(data){
                $('#content_mov').empty();
                $('#content_mov').append(data);
            })
    });
    $('#fecha_final').change(function(){
        var fecha_ini = $('#fecha_inicio').val();
        var fecha_fin = $(this).val();
        var idpro= $proyecto->PRO_ID;
        var idot = $('#id_ot').val();
        var idmat = $('#id_material').val();
            $.get('index.php?r=materiales/buscar-mov-mat',{ idpro : idpro, idmat : idmat, idot : idot, fecha_f : fecha_fin, fecha_i : fecha_ini }, function(data){
                $('#content_mov').empty();
                $('#content_mov').append(data);
            })
    });
JS;
$this->registerJs($script);
?>
