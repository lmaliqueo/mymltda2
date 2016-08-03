<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\EstadoPago */
/* @var $form yii\widgets\ActiveForm */
?>
<br>
<div class="estado-pago-form">
    <?php $form = ActiveForm::begin(); ?>


<?php /*
    <?= $form->field($model, 'EP_NUMEROEP')->textInput(['type'=>'number']) ?>

    <?= $form->field($model, 'EP_FECHA')->textInput() ?>

    <?= $form->field($model, 'EP_PERIODO')->textInput() ?>

    <?= $form->field($model, 'EP_TOTALEP')->textInput() ?>

    <?= $form->field($model, 'EP_FACTURA')->textInput(['maxlength' => true]) ?>
     */ ?>

<div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="no-margin">
            Nuevo Estado de Pago
            <span class="pull-right">
                <?= Html::submitButton($model->isNewRecord ? 'Generar Estado de Pago' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success btn-flat' : 'btn btn-primary btn-flat']) ?>
            </span>
        </h3>
    </div>
    <div class="box-body">
        <div class="box box-primary">
            <div class="box-header">
                <h4 class="box-title">
                    Datos Proyecto
                </h4>
            </div>
            <div class="box-body">

                <?= DetailView::widget([
                    'model' => $ordentrabajo,
                    'attributes' => [
                        [
                            'label'=>'Proyecto',
                            'attribute'=>'pRO.PRO_NOMBRE',
                        ],
                        'pRO.eMPRUT.EMP_RAZON',
                        'pRO.PRO_FECHA_INICIO',
                        'pRO.cOM.COM_NOMBRE',
                        'pRO.PRO_DIRECCION',
                        [
                            'label'=>'Orden de Trabajo',
                            'attribute'=>'OT_NOMBRE',
                        ],
                    ],
                ]) ?>
            </div>
        </div>
        <br>
    </div>
    <div class="box-footer">
        <div class="box box-primary">
            <div class="box-header">
                <h4 class="box-title">
                    Estado de Pago
                </h4>
            </div>
            <div class="box-body">
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
                                        <?= $form->field($row, '['.$count.']AT_CANTIDAD')->textInput(['type' => 'number', 'class' => 'form-control cantidad_ep', 'min'=>0, 'max'=>($key->AS_CANTIDAD - $key->AS_CANTIDADACTUAL),'data' => $key->AS_COSTOTOTAL, 'can_anterior' => $key->AS_CANTIDAD])->label(false) ?>
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
            </div>
        </div>
    </div>
</div>


    <?php ActiveForm::end(); ?>

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

