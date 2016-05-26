<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Actividades;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ActSactAsigna */
/* @var $form yii\widgets\ActiveForm */
?>


<br>


<div class="row">

    <div class="col-md-4">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h4 class="box-title text-blue"><?= $contrato->pERUT->PE_NOMBRES.' '.$contrato->pERUT->PE_APELLIDOPAT.' '.$contrato->pERUT->PE_APELLIDOMAT ?></h4>
            </div>
            <div class="box-body no-padding">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>Rut</th>
                        <td><?= $contrato->PE_RUT ?></td>
                    </tr>
                    <tr>
                        <th>Cargo</th>
                        <td><?= $contrato->pERUT->cA->CA_NOMBRECARGO ?></td>
                    </tr>
                    <tr>
                        <th>Tipo Obrero</th>
                        <td><?= $contrato->tOB->TOB_NOMBRE ?></td>
                    </tr>
                    <tr>
                        <th>Sueldo</th>
                        <td>$ <?= $sueldo->SU_CANTIDAD ?></td>
                    </tr>
                    <tr>
                        <th>Teléfono</th>
                        <td><?= $contrato->pERUT->PE_TELEFONO ?></td>
                    </tr>
                </table>


<?php /*
                <?= DetailView::widget([
                    'model' => $contrato,
                    'attributes' => [
                        'pERUT.PE_RUT',
                        'pERUT.cA.CA_NOMBRECARGO',
                        'tOB.TOB_NOMBRE',
                        'pERUT.PE_TELEFONO',
                    ],
                ]) ?>
<?php 
echo Select2::widget([
    'name' => 'state_2',
    'value' => '',
    'data' => ArrayHelper::map($ordenes,'OT_ID','OT_NOMBRE'),
    'options' => ['multiple' => true, 'placeholder' => 'Select states ...']
]);
?>   



        <div class="panel panel-primary">
            <div class="panel-heading"><span class="glyphicon glyphicon glyphicon-list-alt" aria-hidden="true"></span> <strong>Actividades Asignadas</strong></div>


            <table class="table table-bordered table-hover">
            <tr class="active">
                <th>Actividad</th>
                <th>Fecha de Inicio</th>
                <th>Fecha Termino</th>
                <th>Estado</th>
            </tr>
            <?php foreach ($asignados as $key): ?>
            <tr>
                <td><?= $key->AC_NOMBRE ?></td>
                <td><?= $key->AC_FECHA_INICIO ?></td>
                <td><?= $key->AC_FECHA_TERMINO ?></td>
            <td>
                <?php if($key->AC_ESTADO=='Pendiente'){ ?>
                    <span class="label label-warning"><?= $key->AC_ESTADO ?></span>
                <?php }elseif($key->AC_ESTADO=='Finalizado'){ ?>
                    <span class="label label-success"><?= $key->AC_ESTADO ?></span>
                <?php }elseif ($key->AC_ESTADO=='En proceso') { ?>
                    <span class="label label-primary"><?= $key->AC_ESTADO ?></span>
                <?php } ?>
            </td>

            </tr>
            <?php endforeach ?>


           </table>




        </div>
*/ ?>    
            </div>
        </div>
    </div>




    <div class="col-md-8">



        <div class="box box-solid">
            <div class="box-header with-border">
                <h4 class="box-title" id="proid" pro="<?php echo $contrato->PRO_ID; ?>"><strong>Proyecto:</strong> <?= $contrato->pRO->PRO_NOMBRE ?>    </h4>
            </div>
            <div class="box-body">
                <label class="control-label">Orden de trabajo</label>


<?php 
echo '<label class="control-label"></label>';
echo Select2::widget([
    'name' => 'state_11',
    'data' => ArrayHelper::map($ordenes,'OT_ID','OT_NOMBRE'),
    'disabled' => false,
    'options' => ['placeholder' => 'Selecionar orden de trabajo', 'id'=>'otID', 'perut'=>$contrato->PE_RUT],
    ]);
 ?>





                <?php /*
    <?php $form = ActiveForm::begin(); ?>
        <div class="act-sact-asigna-form">
                <?= $form->field($orden, 'OT_ID')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map($ordenes,'OT_ID','OT_NOMBRE'),
                    'language' => 'es',
                    'options' => ['placeholder' => 'Selecionar orden de trabajo', 'id'=>'otID', 'perut'=>$contrato->PE_RUT],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])->label(false);
                ?>
                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'Asignar' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    <?= Html::a('Listo', ['index'], ['class' => 'btn btn-primary']) ?>
    <?php ActiveForm::end(); ?>

                </div>*/ ?>
                
                <div class="contenidoact">

                </div>

            </div>
        </div>
    </div>
</div>





<?php 
$script = <<< JS

    $('#otID').change(function(){
        var ot = $(this).val();
        var rut= $(this).attr('perut');
            $.get('index.php?r=persona/get-calendario',{ rut : rut, ot : ot }, function(data){
                $('.contenidoact').empty();
                $('.contenidoact').append(data);
            })

    });

    $(document).on('click','.hola',function(){
        /*$('.hola').each(function () {
            $(this).removeClass('active');
        })
        $(this).addClass('active');

        $('.hola').each(function () {
            $(this).css({'border-color':'gray'});
        })
        $(this).css({'border-color':'red'});*/
        var act = $(this).text();
        var idot = $('#otID').val();
        for (i = 1, len = act.length, text = ""; i < len; i++) { 
            text += act[i];
        }

        $.get('index.php?r=persona/asigna-modal',{'act':text , 'ot':idot},function(data){
             $('#modalview').modal('show')
             .find('#modalContent')
             .html(data);
        });

    });


JS;
$this->registerJs($script);
?>

