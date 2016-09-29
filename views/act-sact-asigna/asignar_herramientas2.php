<?php 
namespace app\controllers;

use Yii;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Materiales;
use app\models\Herramientas;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

 ?>


    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>



        <table class="table">
            <tr class="bg-light-blue">
                <th>Herramientas</th>
                <th>Costo</th>
                <th></th>
            </tr>
        </table>
        <?php foreach ($herramientas as $contador => $tipo_he) { ?>
            <?= $this->render('form_he', [
                'form' => $form,
                'model' => $model,
                'array_asignados' => $array_asignados,
                'tipo_he' => $tipo_he,
                'contador' => $contador,
                'arreglo_he' => $arreglo_he[$contador],
            ]) ?>
        <?php } ?>




    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Generar' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>


<?php 
$script = <<< JS

$(function(){
    $(document).on('change', '.idhe', function(e) {
        e.preventDefault()  
        var flag=$(this).val();
        var count= $(this).attr('contador');
        var numeric= document.getElementById(count);

        var costo_actual = document.getElementsByClassName("costoxun");
        if(flag!=''){
            $.get('get-costo-he',{ id : flag }, function(data){
                var data = $.parseJSON(data);

                $(costo_actual[count-1]).text(data.HE_COSTOUNIDAD);
            })
        }else{
                $(costo_actual[count-1]).text(0);
        }
    });


    $(document).on('change', '.cantidad_he', function(e) {
        e.preventDefault()  
        var flag=$(this).val();
        var cantidad=$(this).val();



        var count= $(this).attr('contador');
        var numeric= document.getElementById(count);
        if(flag!=''){
            $(numeric).attr('value',1);
            $(numeric).attr('disabled',false);
        }else{
            $(numeric).attr('value',null);
            $(numeric).attr('disabled',true);
        }

        var costo_actual = $(this).parent().parent().parent().children()[2];
        if(flag!=''){
            $.get('get-costo-he',{ id : flag }, function(data){
                var data = $.parseJSON(data);

                $(costo_actual).text(data.HE_COSTOUNIDAD);
            })
        }else{
                $(costo_actual).text(0);
        }
    });

});


    
JS;
$this->registerJs($script);
?>

