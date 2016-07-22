<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\SpreHeSolicita;
use app\models\Herramientas;
use app\models\Persona;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\SolicitudPrestamo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="solicitud-prestamo-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>


<div class="box">
    <div class="box-body">
        <?= $form->field($model, 'PE_RUT')->dropDownList(
        ArrayHelper::map(Persona::find()->all(),'PE_RUT','PE_NOMBRES'),
        ['prompt'=>'Selecciona una persona']
        ) ?>


        <?= $form->field($model, 'SPRE_TITULO')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'SPRE_DESCRIPCION')->textarea(['rows' => 6]) ?>

    </div>

</div>

<div class="box">
    <div class="box-header">
        <h4 class="box-title">Herramientas</h4>
    </div>
    <div class="box-body">
         <?php DynamicFormWidget::begin([
            'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
            'widgetBody' => '.container-items', // required: css class selector
            'widgetItem' => '.item', // required: css class
            'limit' => $cant_he, // the maximum times, an element can be cloned (default 999)
            'min' => 1, // 0 or 1 (default 1)
            'insertButton' => '.add-item', // css class
            'deleteButton' => '.remove-item', // css class
            'model' => $prestamo[0],
            'formId' => 'dynamic-form',
            'formFields' => [
                'HE_ID',
                'SOLI_CANTIDAD',
            ],
        ]); ?>
        <table class="table table-bordered no-margin">
            <tr class="success">
                <th style="width:20%">Cantidad</th>
                <th style="width:10%">ID</th>
                <th style="width:36%">Descripción</th>
                <th style="width:28%">Tipo Herramienta</th>
                <th><button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button></th>
            </tr>
        </table>
        <div class="container-items">
                <?php foreach ($prestamo as $i => $prest) { ?>
            <table class="table item table-bordered no-margin">
                <tr>
                    <td style="width:20%">
                        <?= $form->field($prest, "[{$i}]SOLI_CANTIDAD")->textInput(['type'=>'number', 'maxlength' => true, 'class'=>'input-group-sm form-control'])->label(false) ?>
                    </td>
                    <td style="width:10%"></td>
                    <td style="width:36%">
                        <?= $form->field($prest, "[{$i}]HE_ID")->dropDownList(
                        ArrayHelper::map(Herramientas::find()->all(),'HE_ID','HE_NOMBRE'),
                        ['prompt'=>'Selecciona una herramienta', 'class'=>'idhe form-control input-group-sm']
                        )->label(false) ?>
                    </td>
                    <td style="width:28%"></td>
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



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Generar' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php 
$script = <<< JS
$(function(){

    $(document).on('change', '.idhe', function(e) {
        e.preventDefault()  

        var herramientaID = $(this).val();
        var array_char = $(this).attr('name');

        var cont = array_char.match(/\d/g);
        cont = cont.join("");
        var array_he = $('.idhe').text();

        var tipo_he = $(this).parent().parent().parent().children()[3];
        var codigo_he = $(this).parent().parent().parent().children()[1];



        if(herramientaID!=''){
            $.get('index.php?r=solicitud-prestamo/get-cantidad',{ id : herramientaID }, function(data){
                var data = $.parseJSON(data);
                document.getElementById("sprehesolicita-"+cont+"-soli_cantidad").value=1;
                document.getElementById("sprehesolicita-"+cont+"-soli_cantidad").setAttribute('max',data.max)
                $(tipo_he).text(data.tipo)
                $(codigo_he).text(data.id)
            })
        }else{
            document.getElementById("sprehesolicita-"+cont+"-soli_cantidad").value=0;
            $(tipo_he).text('')
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
});


JS;
$this->registerJs($script);
?>