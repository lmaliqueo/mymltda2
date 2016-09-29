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

        <h1>Asignar Sub-actividades</h1>
<div class="act-sact-asigna-form">
<br>
    <?php $form = ActiveForm::begin(); ?>










<br>



        <div class="box box-solid">
            <div class="box-header with-border">
                <h4 class="box-title">
                    Buscar Sub-Actividad
                </h4>
                <div class="box-tools">
                    <?= Html::submitButton($model->isNewRecord ? 'Asignar Sub-actividad' : 'Guardar', ['class' => $model->isNewRecord ? 'btn bg-green btn-flat' : 'btn btn-primary']) ?>
                    
                </div>
            </div>

            <div class="box-body">
                <div class="row">
                    <div class="col-sm-3">
                        <?= $form->field($model, 'AS_CANTIDAD')->textInput(['type'=>'number', 'placeholder' => 'Cantidad', 'min'=>1])?>
                    </div>
                    <div class="col-sm-6">
                        <?= $form->field($model, 'SACT_ID')->widget(Select2::classname(), [
                            'data' => ArrayHelper::map($subactividades,'SACT_ID','SACT_NOMBRE'),
                            'language' => 'es',
                            'options' => ['placeholder' => 'Selecionar subactividad', 'class'=>'sactID'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);
                        ?>
                    </div>
                    <div class="colsm-3">
                        <div class="form-group">
                        </div>
                    </div>           
                </div>
                <?php //Html::a('<span class="glyphicon glyphicon glyphicon-ok" aria-hidden="true"></span> Listo', ['actividades/calendario', 'id' => $model->aC->OT_ID], ['class' => 'btn btn-primary']) ?>
            </div>
            <div class="box-footer">
                <div id="subactividad">
                </div>
            </div>
        </div>





</div>

    <?php ActiveForm::end(); ?>
<?php 
$script = <<< JS
    $('.sactID').change(function(){
        var subactividadID = $(this).val();

        if(subactividadID!=''){
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

