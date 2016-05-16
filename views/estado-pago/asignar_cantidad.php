<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EstadoPago */
/* @var $form yii\widgets\ActiveForm */
?>
<br>
<div class="estado-pago-form">


    <?php $form = ActiveForm::begin(); ?>

    <table class="table table-condensed">
        <tr class="bg-light-blue">
            <th>Material</th>
            <th>Stock Actual</th>
            <th>Cantidad Utilizado</th>
            <th>Stock Real</th>
        </tr>
        <?php foreach ($stockmat as $stock){ ?>
        <tr class="table-bordered">
            <td class="active"><?= $stock->mA->MA_NOMBRE ?></td>
            <td><?= $stock->SM_CANTIDAD ?></td>
                    <?php foreach ($arreglo as $count => $row){ ?>
                        <?php if($stock->SM_ID == $row->SM_ID){ ?>
                            <td id="cantidad_actual">
                                <?= $form->field($row, '['.$count.']CU_CANTIDAD')->textInput(['type' => 'number', 'class' => 'cantidad_ep', 'data'=>$stock->SM_CANTIDAD,])->label(false) ?>
                                <td><?php echo $stock->SM_CANTIDAD - $row->CU_CANTIDAD; break;?></td>
                            </td>
                        <?php } ?>
                    <?php } ?>
        </tr>
        <?php } ?>
    </table>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Generar' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>




<?php 
$script = <<< JS

$(function(){
    $(document).on('change', '.cantidad_ep', function(e) {
            e.preventDefault()
        
            var actual = $(this).attr('data');

            var cantidad_actual = $(this).parent().parent().parent().children()[3];
            
            $(cantidad_actual).text(actual - $(this).val())
    });

});



    
JS;
$this->registerJs($script);
?>

