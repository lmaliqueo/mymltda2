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


    <?php $form = ActiveForm::begin(); ?>



    



                    <table class="table table-bordered">
                        <tr class="bg-light-blue">
                            <th>Total</th>
                            <th>Tipo</th>
                            <th>Herramientas</th>
                            <th>Costo</th>
                            <th></th>
                        </tr>
                            <?php $count=0;
                                foreach ($herramientas as $contador => $tipo_he) { 
                                    $flag=0; ?>
                        <tbody class="table">
                                <?php foreach ($arreglo_he as $he){ ?>
                                    <tr>
                                        <td rowspan="<?php echo ($tipo_he->OC_CANTIDAD * $model->AS_CANTIDAD);?>" class='active'><?php echo ($tipo_he->OC_CANTIDAD * $model->AS_CANTIDAD);?></td>
                                        <td rowspan="<?php echo ($tipo_he->OC_CANTIDAD * $model->AS_CANTIDAD);?>" class='active'><?= $tipo_he->tH->TH_NOMBRE ?></td>
                                        <?php for ($i=0; $i < ($tipo_he->OC_CANTIDAD * $model->AS_CANTIDAD); $i++) {  ?>
                                            <?php /*if ($i>0) { ?>
                                                <tr>
                                            <?php } */
                                            $count++;
                                            $cantidad=0;
                                            $disabled=NULL;?>

                                            <?php if ($asignados!=NULL && $flag == 0) { ?>

                                                <?php foreach ($asignados as $exist) { 
                                                    if ($exist->hE->TH_ID== $tipo_he->TH_ID) {?>
                                                        <?php if ($i>0) { ?>
                                                            <tr>
                                                        <?php } ?>
                                                        <td><?= $form->field($exist, '['.$count.']HE_ID')->widget(Select2::classname(), [
                                                                'data' => ArrayHelper::map(Herramientas::find()->where(['TH_ID'=>$tipo_he->TH_ID])->all(),'HE_ID','HE_DESCRIPCION'),
                                                                'language' => 'es',
                                                                'options' => ['placeholder' => 'Selecionar '.$tipo_he->tH->TH_NOMBRE, 'class'=>'idhe '.$count, 'contador'=>$count, 'disabled'=>true,
                                                                /*'onchange'=>'$.post("index.php?r=lista-herramienta&id='.'"+$(this).val(),function(data){
                                                                    $("select#herramientas").html(data);
                                                                } );',*/],
                                                                'pluginOptions' => [
                                                                    'allowClear' => true
                                                                ],
                                                            ])->label(false);
                                                            ?>
                                                        </td>
                                                        <td><?php echo ($exist->hE->HE_COSTOUNIDAD) ?></td>
                                                        <td><?= Html::button('Cambiar Herramienta', ['value'=>$exist->HE_ID, 'class'=> 'btn btn-xs btn-primary ','id'=>'update_he']) ?>
                                                            </td>
                                                    <?php   $i++;
                                                            $count++;
                                                            $cantidad= $cantidad + $exist->HAS_CANTIDAD;
                                                        }?>

                                                <?php }
                                                $flag=1; ?>

                                            <?php }else{
                                                    $flag=1;
                                                }
                                                if ($tipo_he->OC_CANTIDAD==$cantidad) {
                                                    $disabled='true';
                                                }
                                                if($flag==1){ ?>
                                                    <?php if ($i>0) { ?>
                                                        <tr>
                                                    <?php } ?>
                                                    <td><?= $form->field($he, '['.$count.']HE_ID')->widget(Select2::classname(), [
                                                            'data' => ArrayHelper::map(Herramientas::find()->where(['TH_ID'=>$tipo_he->TH_ID])->andWhere(['not in','HE_ID', $array_asignados])->all(),'HE_ID','HE_DESCRIPCION'),
                                                            'language' => 'es',
                                                            'options' => ['placeholder' => 'Selecionar '.$tipo_he->tH->TH_NOMBRE, 'class'=>'idhe', 'contador'=>$count,'disabled'=>$disabled,
                                                                'onchange'=>'$.post("lista-herramienta&id='.'"+$(this).val(),function(data){
                                                                    $("select#herramientas").html(data);
                                                                } )',],
                                                            'pluginOptions' => [
                                                                'allowClear' => true
                                                            ],
                                                        ])->label(false);
                                                        ?>
                                                    </td>
                                            <?php } ?>
                                            <td><span class="costoxun">0</span></td>
                                            <td></td>

                                        <?php } ?>
                                <?php break;
                                    } ?>
                                    </tr>
                        </tbody>
                            <?php } ?>
                    </table>


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

