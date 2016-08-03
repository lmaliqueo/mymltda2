<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Proveedor;
use app\models\Materiales;
use app\models\OrdenTrabajo;
use app\models\Bodegas;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model app\models\MatProvAdquirido */
/* @var $form yii\widgets\ActiveForm */

$this->title='Orden de Compra';
$this->params['breadcrumbs'][] = [
                    'label' => 'Materiales',
                    'url' => ['materiales/index'],
                    //'style'=> 'color:333D43',
                    //'template' => "<li>{link}</li>\n"
                ];
$this->params['breadcrumbs'][] = [
                    'label' => 'Adquisición Materiales',
                    'url' => ['materiales/orden-compra-index'],
                    //'style'=> 'color:333D43',
                    //'template' => "<li>{link}</li>\n"
                ];
$this->params['breadcrumbs'][] = 'Crear Orden de Compra';

?>

<div class="materiales-form">


    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

        <?php /*
            <?= $form->field($model, 'MA_ID')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Materiales::find()->all(),'MA_ID','MA_NOMBRE'),
                'language' => 'es',
                'options' => ['placeholder' => 'Seleccione Material', 'id'=>'matID'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);?>
        <?= $form->field($model, 'AD_CANTIDAD')->textInput(['type'=>'number', 'min'=>0]) ?>
        <?= $form->field($model, 'AD_COSTO_TOTAL',['template' => '
            {label}
           <div class="input-group">
                <span class="input-group-addon" id="sizing-addon1">$</span>
              {input}
           </div>
           {error}{hint}'])->textInput(['type'=>'number','disabled'=>true]) ?>

            */ ?>


<div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="no-margin">Registrar Orden de Compra
            <span class="pull-right">
                <?= Html::submitButton($orden_compra->isNewRecord ? '<i class="glyphicon glyphicon-save"></i> Guardar' : 'Guardar', ['class' => $orden_compra->isNewRecord ? 'btn btn-success btn-flat' : 'btn btn-primary btn-flat']) ?>
            </span> 
        </h3>
    </div>
    <div class="box-body">
        <div class="box box-primary">
            <div class="box-header">
                <h4 class="box-title">Datos de la Orden de Compra</h4>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <label class="control-label">N° ORDEN: </label>
                        <span id="num-orden"></span>  
                        <br>
                        <label class="control-label">PROYECTO: </label>
                        <span id="pro-name"></span>
                        <br>
                        <label class="control-label">DIRECCIÓN: </label>
                        <span id="pro-direc"></span>
                    </div>
                    <div class="col-md-6">
                        <label class="control-label">FECHA PEDIDO: </label>
                        <?= $orden_compra->ORC_FECHA_PEDIDO ?>
                        <br>
                        <label class="control-label">CIUDAD: </label>
                        <span id="pro-ciud"></span>
                        <br>
                        <label class="control-label">ENVIAR: </label>
                        <h3 class="label label-success" id="destino_mat">Construcción</h3>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <?= $form->field($orden_compra, 'PROV_ID',['template'=>'
                    <div class="row">
                        <div class="col-md-2">
                            <div class="pull-right">
                                {label}
                            </div>
                        </div>
                        <div class="col-md-7 no-padding">
                            {input}
                        </div>
                        <div class="col-md-3">
                            {error}
                        </div>
                    </div>'
                    ,])->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(Proveedor::find()->all(),'PROV_ID','PROV_NOMBRE'),
                    'language' => 'es',
                    'options' => ['placeholder' => 'Selecionar proveedor'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>

                <?= $form->field($orden_compra, 'OT_ID',['template'=>'
                        <div class="row">
                            <div class="col-md-2">
                                <div class="pull-right">
                                    {label}
                                </div>
                            </div>
                            <div class="col-md-7 no-padding">
                                {input}
                            </div>
                            <div class="col-md-3">
                                {error}
                            </div>
                        </div>'
                    ,])->widget(Select2::classname(), [
                    'data' => ArrayHelper::map($ordenes_trabajos,'OT_ID','OT_NOMBRE','pRO.PRO_NOMBRE'),
                    'language' => 'es',
                    'options' => ['placeholder' => 'Seleccionar OT', 'id'=>'id_ot'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);?>
                <?= $form->field($model, 'BO_ID',['template'=>'
                        <div class="row">
                            <div class="col-md-2">
                                <div class="pull-right">
                                    {label}
                                </div>
                            </div>
                            <div class="col-md-7 no-padding">
                                {input}
                            </div>
                            <div class="col-md-3">
                                {error}
                            </div>
                        </div>'
                    ,])->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(Bodegas::find()->all(),'BO_ID','BO_NOMBRE'),
                    'language' => 'es',
                    'options' => ['placeholder' => 'Seleccionar Bodega'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);?>
            </div>
        </div>
                 <?php DynamicFormWidget::begin([
                    'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                    'widgetBody' => '.container-items', // required: css class selector
                    'widgetItem' => '.item', // required: css class
                    'limit' => $cant_materiales, // the maximum times, an element can be cloned (default 999)
                    'min' => 1, // 0 or 1 (default 1)
                    'insertButton' => '.add-item', // css class
                    'deleteButton' => '.remove-item', // css class
                    'model' => $adquisiciones[0],
                    'formId' => 'dynamic-form',
                    'formFields' => [
                        'MA_ID',
                        'AD_CANTIDAD',
                        'AD_COSTO_TOTAL',
                    ],
                ]); ?>


        <div class="box box-primary">
            <div class="box-header">
                <h4 class="box-title">Materiales</h4>
            </div>
            <div class="box-body no-padding">
                <table class="table talbe-bordered no-margin bg-light-blue">
                    <tr>
                        <th style="width:15%">Cantidad</th>
                        <th style="width:15%">Código</th>
                        <th style="width:39%">Descripción</th>
                        <th style="width:25%">Costo Total</th>
                        <th style="width:6%"><button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button></th>
                    </tr>
                </table>

                <div class="container-items">
                        <?php foreach ($adquisiciones as $i => $adquisicion) { ?>
                    <table class="table item table-bordered no-margin">
                        <tr>
                            <td  style="width:15%">
                                <?= $form->field($adquisicion, "[{$i}]AD_CANTIDAD")->textInput(['maxlength' => true,'type'=>'number', 'class'=>'form-control cant_mat', 'min'=>1,])->label(false) ?>
                            </td>
                            <td  style="width:15%">
                                <?= $form->field($adquisicion, "[{$i}]MA_ID")->textInput(['maxlength' => true, 'class'=>'form-control idmat',])->label(false) ?>
                                <?php /*
                                    <?= $form->field($adquisicion, "[{$i}]MA_ID")->dropDownList(
                                    ArrayHelper::map(Materiales::find()->all(),'MA_ID','MA_NOMBRE'),
                                    ['prompt'=>'Seleccione un material', 'class'=>'idmat form-control',]
                                    )->label(false) ?>
                                */ ?>
                            </td>
                            <td style="width:39%">-</td>
                            <td><?= $form->field($adquisicion, "[{$i}]AD_COSTO_TOTAL")->textInput(['maxlength' => true,'input_costo'=>$i, 'type'=>'number', 'disabled'=>true, 'class'=>'costo_mat form-control'])->label(false) ?></td>
                            <td>
                                <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i></button>
                            </td>
                        </tr>
                    </table>
                        <?php } ?>
                </div>
                <?php DynamicFormWidget::end(); ?>
            </div>
        </div>
    </div>



</div>







</div>



    <?php ActiveForm::end(); ?>

</div>

<?php 
$script = <<< JS
$(function(){

    $(document).on('change', '.idmat', function(e) {
        e.preventDefault()  

        var materialID = $(this).val();
        var array_char = $(this).attr('name');

        var cont = array_char.match(/\d/g);
        cont = cont.join("");
        var array_mat = $('.idmat').text();

        if(materialID!=''){
            $.get('index.php?r=mat-prov-adquirido/get-costo',{ id : materialID }, function(data){
                var data = $.parseJSON(data);
                document.getElementById("matorcadquirido-"+cont+"-ad_cantidad").value=1;
                document.getElementById("matorcadquirido-"+cont+"-ad_costo_total").value=data.MA_COSTOUNIDAD;
            })
            $.post("index.php?r=materiales/lista-no-incluidos&array_mat='.'"+array_mat,function(data){
                $("select.idmat").html(data);
            } )
        }else{
            document.getElementById("matorcadquirido-"+cont+"-ad_cantidad").value=0;
            document.getElementById("matorcadquirido-"+cont+"-ad_costo_total").value=0;
       }
    });
    $(document).on('change', '.cant_mat', function(e) {
        e.preventDefault()  

        var cant = $(this).val();
        var array_char = $(this).attr('name');


        var cont = array_char.match(/\d/g);
        cont = cont.join("");

        var id_mat=$('#matorcadquirido-'+cont+'-ma_id').val();

        if(cant!=''){
            $.get('index.php?r=mat-prov-adquirido/get-costo',{ id : id_mat }, function(data){
                var data = $.parseJSON(data);
                document.getElementById("matorcadquirido-"+cont+"-ad_costo_total").value=data.MA_COSTOUNIDAD * cant;
            })

        }else{
            document.getElementById("matorcadquirido-"+cont+"-ad_costo_total").value=0;
        }
    });
    $(document).on('change', '#bomatalmacena-bo_id', function(e) {
        var contenido = $(this).val();
        if (contenido != '') {
            $('#destino_mat').empty();
            $('#destino_mat').append('Bodega');
        }else{
            $('#destino_mat').empty();
            $('#destino_mat').append('Construcción');
        }
    });


    $(document).on('change', '#id_ot', function(e) {
        var idot = $(this).val();
        if(idot!=''){
            $.get('index.php?r=materiales/get-ot',{ id : idot }, function(data){
                var data = $.parseJSON(data);
                $('#num-orden').empty();
                $('#num-orden').append(data.numero_orden);
                $('#pro-name').empty();
                $('#pro-name').append(data.proyecto);
                $('#pro-direc').empty();
                $('#pro-direc').append(data.direccion);
                $('#pro-ciud').empty();
                $('#pro-ciud').append(data.ciudad);
            })

        }else{
            $('#num-orden').empty();
            $('#pro-name').empty();
            $('#pro-direc').empty();
            $('#pro-ciud').empty();
        }
    });
});


JS;
$this->registerJs($script);
?>