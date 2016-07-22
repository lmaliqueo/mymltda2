<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EstadoPago */
/* @var $form yii\widgets\ActiveForm */
?>
<br>
<div class="estado-pago-form">

        <div class="box box-primary">
    <div class="box-body">

    <?php $form = ActiveForm::begin(); ?>
<?php /*
    <?= $form->field($model, 'EP_NUMEROEP')->textInput(['type'=>'number']) ?>

    <?= $form->field($model, 'EP_FECHA')->textInput() ?>

    <?= $form->field($model, 'EP_PERIODO')->textInput() ?>

    <?= $form->field($model, 'EP_TOTALEP')->textInput() ?>

    <?= $form->field($model, 'EP_FACTURA')->textInput(['maxlength' => true]) ?>
     */ ?>

     <div class="row">
        <div class="col-md-5">
            <dl class="dl-horizontal">
                <dt>CLIENTE</dt>
                <dd><?= $proyecto->eMPRUT->EMP_RAZON ?></dd>

                <dt>RUT</dt>
                <dd><?= $proyecto->EMP_RUT ?></dd>

                <dt>ESTADO PAGO</dt>
                <dd>Estado de Pago N° <?= $model->EP_NUMEROEP ?></dd>

                <dt>FECHA E.P.</dt>
                <dd><?= $model->EP_FECHA?></dd>

                <dt>NOMBRE DE LA OBRA</dt>
                <dd><?= $proyecto->PRO_NOMBRE?></dd>

                <dt>DIRECCIÓN</dt>
                <dd><?= $proyecto->eMPRUT->EMP_DIRECCION ?></dd>

                <dt>FECHA INICIO</dt>
                <dd><?= $proyecto->PRO_FECHA_INICIO?></dd>

                <dt>FECHA TERMINO</dt>
                <dd><?= $proyecto->PRO_FECHA_FINAL?></dd>

                <dt>FONOS</dt>
                <dd><?= $proyecto->eMPRUT->EMP_TELEFONO ?></dd>

            </dl>
        </div>
     </div>
<br>
    <table class="table table-condensed table-bordered">
        <thead>
        <tr class="bg-light-blue">
            <th>Items</th>
            <th>Cantidad Contratada</th>
            <th>Precio Unitario Contratado</th>
            <th>Precio Total Contratado</th>
            <th>Cantidad a la Fecha</th>
            <th>Costo a la Fecha</th>
            <th>Cantidad Anterior</th>
            <th>EP Anterior</th>
            <th>Cantidad EP actual</th>
            <th>EP actual</th>
        </tr></thead>
        <?php foreach ($actividades as $i=>$act): ?>
        <tr class="active">
            <th colspan="10"><?= $act->AC_NOMBRE?></td>
        </tr>
            <tbody class="table table-bordered">


            <?php 
            foreach ($asignados as $key){ ?>
            <tr>
                <?php if ($act->AC_ID==$key->AC_ID) { ?>
                <td><ul><li><?= $key->sACT->SACT_NOMBRE ?></li></ul></td>
                <td><?= $key->AS_CANTIDAD ?></td>
                <td class="costo_sub" data="<?php echo $key->sACT->SACT_COSTO; ?>">$<?= $key->sACT->SACT_COSTO ?></td>
                <td>$ <?= $key->AS_COSTOTOTAL ?></td>
                <?php /*
                <?php foreach ($arreglo as $count => $row){ ?>
                    <?php if($key->AS_ID == $row->AS_ID){ ?>
                        <td id="cantidad_actual">
                            <?= $form->field($row, '['.$count.']AT_CANTIDAD')->textInput(['type' => 'number', 'class' => 'cantidad_ep', 'data' => $key->sACT->SACT_COSTO, 'can_anterior' => $key->AS_CANTIDADACTUAL])->label(false) ?>
                        </td>
                        <td id="costo_actual" data='<?php echo $row->AS_ID; ?><?php echo $key->AS_ID; ?>'><?= $row->AT_COSTO_EP ?></td>
                    <?php } ?>
                <?php } ?>*/ ?>
                <td><?= $key->AS_CANTIDADACTUAL ?></td>
                <td>$ <?= $key->AS_COSTOACTUAL ?></td>
                <td><?= $key->AS_CANTIDADACTUAL ?></td>
                <td>$ <?= $key->AS_COSTOACTUAL ?></td>
                <?php foreach ($arreglo as $count => $row){ ?>
                    <?php if($key->AS_ID == $row->AS_ID){ ?>
                        <td id="cantidad_actual"class="warning" >
                            <?= $form->field($row, '['.$count.']AT_CANTIDAD')->textInput(['type' => 'number', 'class' => 'cantidad_ep', 'min'=>0, 'max'=>($key->AS_CANTIDAD - $key->AS_CANTIDADACTUAL),'data' => $key->AS_COSTOTOTAL, 'can_anterior' => $key->AS_CANTIDAD])->label(false) ?>
                        </td>
                        <td class="warning" id="costo_actual" data='<?php echo $row->AS_ID; ?><?php echo $key->AS_ID; ?>'>$ <?= $row->AT_COSTO_EP ?></td>
                    <?php } ?>
                <?php } ?>
                <?php } ?>
            </tr>
            <?php } ?>
                </tbody>
   
        <?php endforeach; ?>
    </table>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Generar' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
</div>




<?php 
$script = <<< JS

$(function(){
    $(document).on('change', '.cantidad_ep', function(e) {
            e.preventDefault()
            

            var sub = eval($(this).attr('data'));
            var antes = eval($(this).attr('can_anterior'));
            var costo = sub/antes;


            var cantidad_fecha = $(this).parent().parent().parent().children()[4];
            var costo_actual = $(this).parent().parent().parent().children()[5];
            var costo_real = $(this).parent().parent().parent().children()[9];
            
            $(cantidad_fecha).text(eval($(this).val()) + antes)
            $(costo_actual).text((($(this).val() * costo) + sub))
            $(costo_real).text(($(this).val()) * costo)
    });

});


    
JS;
$this->registerJs($script);
?>

