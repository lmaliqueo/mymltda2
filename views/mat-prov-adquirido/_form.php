<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Proveedor;
use app\models\Materiales;
use app\models\OrdenTrabajo;
use app\models\Bodegas;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\MatProvAdquirido */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mat-prov-adquirido-form">

    <?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'PROV_ID')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Proveedor::find()->all(),'PROV_ID','PROV_NOMBRE'),
    'language' => 'es',
    'options' => ['placeholder' => 'Selecionar proveedor'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]);
?>



<?= $form->field($almacena, 'BO_ID')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Bodegas::find()->all(),'BO_ID','BO_NOMBRE'),
    'language' => 'es',
    'options' => ['placeholder' => 'Seleccionar Bodega'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]);?>


<?= $form->field($model, 'MA_ID')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Materiales::find()->all(),'MA_ID','MA_NOMBRE'),
    'language' => 'es',
    'options' => ['placeholder' => 'Seleccione Material', 'id'=>'matID'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]);?>



<?= $form->field($stock, 'OT_ID')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(OrdenTrabajo::find()->all(),'OT_ID','OT_NOMBRE'),
    'language' => 'es',
    'options' => ['placeholder' => 'Select a state ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]);?>

    <?= $form->field($transaccion, 'TM_CANTIDAD')->textInput() ?>

    <?= $form->field($transaccion, 'TM_PRECIO')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php 
$script = <<< JS
    $('#matID').change(function(){
        var materialID = $(this).val();



        if(materialID!=''){
            $.get('index.php?r=mat-prov-adquirido/get-costo',{ id : materialID }, function(data){
                var data = $.parseJSON(data);
                $('#transaccionmateriales-tm_precio').attr('value',data.MA_COSTOUNIDAD);
                $('#transaccionmateriales-tm_cantidad').attr('value',1);
            })

        }else{

                $('#transaccionmateriales-tm_precio').attr('value',0);
                $('#transaccionmateriales-tm_cantidad').attr('value',0);
       }

    });
    $('#transaccionmateriales-tm_cantidad').change(function(){
        var cantidad = $(this).val();
        var id = $('#matID').val();
        $.get('index.php?r=mat-prov-adquirido/get-costo-total',{ cantidad : cantidad, id : id }, function(data){
            $('#transaccionmateriales-tm_precio').attr('value',data);
        })
    });
JS;
$this->registerJs($script);
?>