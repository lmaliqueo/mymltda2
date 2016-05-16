<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Subactividades;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\ActSactAsigna */
/* @var $form yii\widgets\ActiveForm */
?>
<?php 
    Modal::begin([
            'header'=>'<h4>Sub-Actividad</h4>',
            'id'=>'modal',
            'size'=>'modal-lg',
        ]);
    echo "<div class='modalContent'></div>";
    Modal::end();
 ?>


        <h1><span class="glyphicon glyphicon glyphicon-pushpin" aria-hidden="true"></span> Asignar Sub-actividades</h1>
<div class="act-sact-asigna-form">
<br>
    <?php $form = ActiveForm::begin(); ?>


                        <div class="form-group">
                            <?= Html::submitButton($model->isNewRecord ? '<span class="glyphicon glyphicon glyphicon-save" aria-hidden="true"></span> Asignar' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                            <?= Html::a('<span class="glyphicon glyphicon glyphicon-ok" aria-hidden="true"></span> Listo', ['actividades/calendario', 'id' => $model->aC->OT_ID], ['class' => 'btn btn-primary']) ?>
                        </div>

<div class="row">
    <div class="col-md-6">
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-3">
                        <?= $form->field($model, 'AS_CANTIDAD')->textInput(['type'=>'number']) ?>
                    </div>
                    <div class="col-sm-9">
                        <?= $form->field($model, 'SACT_ID')->widget(Select2::classname(), [
                            'data' => ArrayHelper::map($subactividades,'SACT_ID','SACT_NOMBRE'),
                            'language' => 'es',
                            'options' => ['placeholder' => 'Selecionar subactividad', 'id'=>'sactID'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);
                        ?>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <div id="subactividad">
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">

        <div class="box box-primary">
            <div class="box-header with-border"><h4 class="box-title">Subactividades Asignados</h4>
                <div class="box-tools"><h3 class="text-blue no-margin">$ <?= $actividad->AC_COSTO_TOTAL ?></h3></div>
            </div>
            <div class="box-body no-padding">
                <table class="table">
                    <tr class="bg-light-blue">
                        <th>Cantidad</th>
                        <th>Subactividad</th>
                        <th>Costo por Subactividad</th>
                        <th></th>
                        <th></th>
                   </tr>
                <tbody class="table table-bordered">
                    <?php foreach ($asignados as $key): ?>
                        <tr>
                            <td><?= $key->AS_CANTIDAD ?></td>
                            <td><?= $key->sACT->SACT_NOMBRE ?></td>
                            <td>$ <?= $key->AS_COSTOTOTAL ?></td>
                            <td>
                                <div class="form-group no-margin">
                                    <?= Html::button('<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>', ['value'=>Url::to(['act-sact-asigna/asignar-recursos','id'=>$key->AS_ID]), 'class'=> 'btn btn-xs btn-primary modalButton','id'=>'modalButton', 'title'=>'Asignar Recursos']) ?>
                                    <?= Html::button('<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>', ['value'=>Url::to(['act-sact-asigna/asignar-herramientas','id'=>$key->AS_ID]), 'class'=> 'btn btn-xs btn-success modalHe','id'=>'modalHe', 'title'=>'Asignar Herramienta']) ?>
                                </div>
                            </td>
                            <td>                                    <?= Html::a('<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>', ['delete', 'id' => $key->AS_ID], [
                                        'class' => 'btn btn-xs btn-danger',
                                        'data' => [
                                            'confirm' => '¿Esta seguro de borrar este vinculo?',
                                            'method' => 'post',
                                        ],
                                    ]) ?>
                            </td>
                        </tr>
                    <?php endforeach ?>

                </tbody>
               </table>
            </div>
        </div>
    </div>
</div>




</div>

    <?php ActiveForm::end(); ?>
<?php 
$script = <<< JS
    $('#sactID').change(function(){
        var subactividadID = $(this).val();

        if(subactividadID!=''){
            $.get('index.php?r=act-sact-asigna/get-costo',{ id : subactividadID }, function(data){
                var data = $.parseJSON(data);
                $('#actsactasigna-as_costototal').attr('value',data.SACT_COSTO);
                $('#actsactasigna-as_cantidad').attr('value',1);
            })
            $.get('index.php?r=act-sact-asigna/get-costo',{ id : subactividadID }, function(data){
                var data = $.parseJSON(data);
                $('#actsactasigna-as_costototal').attr('value',data.SACT_COSTO);
                $('#actsactasigna-as_cantidad').attr('value',1);
            })
            $.get('index.php?r=act-sact-asigna/get-subactividad',{ id : subactividadID }, function(data){
                 $('#subactividad').empty();
                $('#subactividad').append(data);
            })
        }else{

                $('#actsactasigna-as_cantidad').attr('value',0);
                $('#actsactasigna-as_costototal').attr('value',0);
                 $('#subactividad').empty();
       }
    });

    $('#actsactasigna-as_cantidad').change(function(){
        var cantidad = $(this).val();
        var id = $('#sactID').val();
        $.get('index.php?r=act-sact-asigna/get-costo-total',{ cantidad : cantidad, id : id }, function(data){
            $('#actsactasigna-as_costototal').attr('value',data);
        })
    });
   $('.modalHe').click(function() {
     $('#modal').modal('show')
     .find('.modalContent')
     .load($(this).attr('value'));
   });
   $('.modalButton').click(function() {
     $('#modal').modal('show')
     .find('.modalContent')
     .load($(this).attr('value'));
   });
JS;
$this->registerJs($script);
?>

