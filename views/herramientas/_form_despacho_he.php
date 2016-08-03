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
$this->title = 'Registrar Despacho';
$this->params['breadcrumbs'][] = ['label' => 'Herramientas', 'url' => ['herramientas/index']];
$this->params['breadcrumbs'][] = ['label' => 'Despacho Herramientas', 'url' => ['herramientas/despachos-index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="materiales-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>




<br>

<div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="no-margin">
            Registrar Despachos
        </h3>
        <span class="box-tools">
                <?= Html::submitButton($despacho_he->isNewRecord ? '<i class="glyphicon glyphicon-save"></i> Guardar' : 'Guardar', ['class' => $despacho_he->isNewRecord ? 'btn btn-default btn-flat bg-green' : 'btn btn-primary', 'style'=>'border-width: 1px; border-color: green;']) ?>
            </span>
    </div>
    <div class="box-body">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($despacho_he, 'OT_ID')->widget(Select2::classname(), [
                            'data' => ArrayHelper::map($ordenes_trabajos,'OT_ID','OT_NOMBRE','pRO.PRO_NOMBRE'),
                            'language' => 'es',
                            'options' => ['placeholder' => 'Selecionar orden de trabajo', 'class'=>'id_ot',
                                                /*'onchange'=>'$.post("index.php?r=materiales/lista-materiales&id='.'"+$(this).val(),function(data){
                                                    $("select.idmat").html(data);
                                                } )',*/],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])->label('Enviar a');
                        ?>
                    </div>
                    <div class="col-md-6">
                        <label class="control-label">
                            Encargado Responsable
                        </label>
                        <?php 
                            echo Select2::widget([
                                'name' => 'encargado',
                                'value' => '',
                                'data' => [0 => "-",],
                                'options' => ['placeholder' => 'Seleccionar encargado de obras', 'id'=>'tipo'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]);
                        ?>
                    </div>
                </div>

            </div>
        </div>














         <?php DynamicFormWidget::begin([
            'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
            'widgetBody' => '.container-items', // required: css class selector
            'widgetItem' => '.item', // required: css class
            'limit' => $cant_herramientas, // the maximum times, an element can be cloned (default 999)
            'min' => 1, // 0 or 1 (default 1)
            'insertButton' => '.add-item', // css class
            'deleteButton' => '.remove-item', // css class
            'model' => $salidas_herramientas[0],
            'formId' => 'dynamic-form',
            'formFields' => [
                'ESP_CANTIDAD_DESPACHO',
                'AL_ID',
            ],
        ]); ?>



        <div class="box box-primary">
            <div class="box-header">
                <h4 class="box-title">Herramientas</h4>
            </div>
            <div class="box-body">
                <table class="table table-bordered no-margin bg-light-blue">
                    <tr>
                        <th style="width:11%">Código</th>
                        <th style="width:27%">Descripción</th>
                        <th style="width:15%">Tipo Herramienta</th>
                        <th style="width:15%">Bodega</th>
                        <th style="width:10%">Estado</th>
                        <th style="width:15%">Costo Asociado</th>
                        <th style="width:5%"><button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button></th>
                    </tr>
                </table>

                <div class="container-items">
                        <?php foreach ($salidas_herramientas as $i => $salida_he) { ?>
                    <table class="table item table-bordered no-margin">
                        <tr>
                            <td style="width:11%">
                                <?= $form->field($salida_he, "[{$i}]HE_ID")->textInput(['maxlength' => 10, 'class'=>'form-control id_he input-sm'])->label(false) ?>
                            </td>
                            <td style="width:27%">
                                <?php /*
                                <?= $form->field($salida_he, "[{$i}]AL_ID")->dropDownList(
                                    ArrayHelper::map(BoMatAlmacena::find()->all(),'AL_ID','mA.MA_NOMBRE'),
                                    ['prompt'=>'Seleccione un material', 'class'=>'idmat form-control no-margin']
                                    )->label(false) ?>*/ ?>
                            </td>
                            <td style="width:15%"></td>
                            <td style="width:15%"></td>
                            <td style="width:10%"></td>
                            <td style="width:15%"></td>
                            <td style="width:5%">
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







    <?php ActiveForm::end(); ?>

</div>


<?php 
$script = <<< JS
$(function(){

    $(document).on('change', '.id_he', function(e) {
        e.preventDefault()  

        var herramientaID = $(this).val();
        var array_char = $(this).attr('name');

        var cont = array_char.match(/\d/g);
        cont = cont.join("");


            var descripcion = $(this).parent().parent().parent().children()[1];
            var tipo_herramienta = $(this).parent().parent().parent().children()[2];
            var bodega = $(this).parent().parent().parent().children()[3];
            var estado = $(this).parent().parent().parent().children()[4];
            var costo_asociado = $(this).parent().parent().parent().children()[5];



        if(herramientaID!=''){
            $.get('index.php?r=herramientas/get-herramienta',{ id : herramientaID }, function(data){
                var data = $.parseJSON(data);
                    $(descripcion).text(data.descripcion)
                    $(tipo_herramienta).text(data.tipo_herramienta)
                    $(bodega).text(data.bodega)
                    $(estado).text(data.estado)
                    $(costo_asociado).text(data.costo_asociado)
            })

        }else{
            $(descripcion).text('-')
            $(tipo_herramienta).text('-')
            $(bodega).text('-')
            $(costo_asociado).text('-')
        }
    });
});


JS;
$this->registerJs($script);
?>