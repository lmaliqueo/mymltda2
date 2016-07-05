<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\BoMatAlmacena;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model app\models\Materiales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="materiales-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>




<div class="box box-solid">
    <div class="box-header bg-gray">
        <h4 class="box-title">Datos de Orden de Despacho</h4>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
                <label class="control-label">N° ORDEN: </label>
                <?= $orden_despacho->OD_NUMERO_ORDEN ?>
                <br>
                <label class="control-label">PROYECTO: </label>
                <?= $proyecto->PRO_NOMBRE ?>
                <br>
                <label class="control-label">DIRECCIÓN: </label>
                <?= $proyecto->PRO_DIRECCION ?>
            </div>
            <div class="col-md-6">
                <label class="control-label">FECHA EMISIÓN: </label>
                <?= $orden_despacho->OD_FECHA_EMISION ?>
                <br>
                <label class="control-label">CIUDAD: </label>
                <?= $proyecto->cOM->COM_NOMBRE ?>
            </div>
        </div>

    </div>
    <div class="box-footer">
        <?= $form->field($model, 'OT_ID',['template'=>'
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
            'data' => ArrayHelper::map($ordenes_trabajos,'OT_ID','OT_NOMBRE'),
            'language' => 'es',
            'options' => ['placeholder' => 'Selecionar orden de trabajo', 'class'=>'id_ot',
                                'onchange'=>'$.post("index.php?r=materiales/lista-materiales&id='.'"+$(this).val(),function(data){
                                    $("select.idmat").html(data);
                                } )',],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
        ?>
    </div>
</div>







         <?php DynamicFormWidget::begin([
            'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
            'widgetBody' => '.container-items', // required: css class selector
            'widgetItem' => '.item', // required: css class
            'limit' => 10, // the maximum times, an element can be cloned (default 999)
            'min' => 0, // 0 or 1 (default 1)
            'insertButton' => '.add-item', // css class
            'deleteButton' => '.remove-item', // css class
            'model' => $despachos[0],
            'formId' => 'dynamic-form',
            'formFields' => [
                'ESP_CANTIDAD_DESPACHO',
                'AL_ID',
            ],
        ]); ?>

    <table class="table talbe-bordered no-margin bg-gray">
        <tr>
            <th style="width:11%">Cantidad</th>
            <th style="width:27%">Material</th>
            <th style="width:9%">Código</th>
            <th style="width:18%">Bodega</th>
            <th style="width:9%">Unidad</th>
            <th>Costo Total</th>
            <th style="width:9%"><button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button></th>
        </tr>
    </table>

    <div class="container-items">
            <?php foreach ($despachos as $i => $despacho) { ?>
        <table class="table item table-bordered no-margin">
            <tr>
                <td style="width:11%">
                    <?= $form->field($despacho, "[{$i}]ESP_CANTIDAD_DESPACHO")->textInput(['maxlength' => true,'type'=>'number', 'class'=>'form-control cant_mat'])->label(false) ?>
                </td>
                <td style="width:27%">
                    <?= $form->field($despacho, "[{$i}]AL_ID")->dropDownList(
                        ArrayHelper::map(BoMatAlmacena::find()->all(),'AL_ID','mA.MA_NOMBRE'),
                        ['prompt'=>'Seleccione un material', 'class'=>'idmat form-control no-margin']
                        )->label(false) ?>
                </td>
                <td style="width:9%"></td>
                <td style="width:17%"></td>
                <td style="width:9%"></td>
                <td style="width:17%"></td>
                <td style="width:9%">
                    <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i></button>
                </td>
            </tr>
        </table>
            <?php } ?>
    </div>
            <?php DynamicFormWidget::end(); ?>









    <div class="form-group">
        <?= Html::submitButton($orden_despacho->isNewRecord ? 'Crear' : 'Guardar', ['class' => $orden_despacho->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
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


        if(materialID!=''){
            $.get('index.php?r=mat-prov-adquirido/get-costo',{ id : materialID }, function(data){
                var data = $.parseJSON(data);
                document.getElementById("odmatespecifica-"+cont+"-esp_cantidad_despacho").value=1;
            })

        }else{
            document.getElementById("odmatespecifica-"+cont+"-esp_cantidad_despacho").value=0;
        }
    });
    $(document).on('change', '.cant_mat', function(e) {
        e.preventDefault()  

        var cant = $(this).val();
        var array_char = $(this).attr('name');

        var cont = array_char.match(/\d/g);
        cont = cont.join("");


        if(cant!=''){
            $.get('index.php?r=mat-prov-adquirido/get-costo',{ id : cant }, function(data){
                var data = $.parseJSON(data);
                document.getElementById("odmatespecifica-"+cont+"-esp_cantidad_despacho").value=1;
            })

        }else{
            document.getElementById("odmatespecifica-"+cont+"-esp_cantidad_despacho").value=0;
       }
    });
});


JS;
$this->registerJs($script);
?>