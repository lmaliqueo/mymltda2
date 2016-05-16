<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Subactividades;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\ActSactAsigna */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="act-sact-asigna-form">
<br>
    <?php $form = ActiveForm::begin(); ?>

                        <div class="row">
                            <div class="col-sm-5">

<?= $form->field($model, 'SACT_ID')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Subactividades::find()->all(),'SACT_ID','SACT_NOMBRE'),
    'language' => 'es',
    'options' => ['placeholder' => 'Selecionar subactividad', 'id'=>'sactID'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]);
?>
                        <div class="row">
                            <div class="col-sm-6">


    <?= $form->field($model, 'AS_CANTIDAD')->textInput() ?>
                            </div>
                            <div class="col-sm-6">


    <?= $form->field($model, 'AS_COSTOTOTAL')->textInput() ?>

                            </div>




                            </div>
 

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Asignar' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
  

        <?= Html::a('Listo', ['actividades/calendario', 'id' => $model->aC->OT_ID], ['class' => 'btn btn-primary']) ?>

    </div>



                            </div>
                            <div class="col-md-offset-6">

                                <div class="panel panel-primary">
                                   <div class="panel-heading"><h4 class="text-center"><strong>Subactividades Asignados</strong></h4></div>


                                            <table class="table table-bordered">
                                        <tr>
                                            <th>Cantidad</th>
                                            <th>Subactividad</th>
                                            <th>Costo por Subactividad</th>
                                       </tr>
                                        <?php foreach ($asignados as $key): ?>
                                        <tr>
                                                        <td><?= $key->AS_CANTIDAD ?></td>
                                                        <td><?= $key->sACT->SACT_NOMBRE ?></td>
                                                        <td><?= $key->AS_COSTOTOTAL ?></td>
                                        </tr>
                                        <?php endforeach ?>


                                       </table>




                                    </div>
                                    </div>

                            </div>


                            <div class="row">

                            <div id="subactividad">

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
JS;
$this->registerJs($script);
?>

