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








                    <table class="table">
                        <tr class="bg-green">
                            <th>Total</th>
                            <th>Tipo</th>
                            <th>Cantidad</th>
                            <th>Herramientas</th>
                            <th>Costo Asociasdo</th>
                        </tr>
                            <?php $count=0;
                                foreach ($herramientas as $contador => $tipo_he) { 
                                    $flag=0; ?>
                        <tbody class="table table-bordered">
                                <?php foreach ($arreglo_he as $he){ ?>
                                    <tr>
                                        <td rowspan="<?php echo ($tipo_he->OC_CANTIDAD * $model->AS_CANTIDAD);?>" class='active'><?php echo ($tipo_he->OC_CANTIDAD * $model->AS_CANTIDAD);?></td>
                                        <td rowspan="<?php echo ($tipo_he->OC_CANTIDAD * $model->AS_CANTIDAD);?>" class='active'><?= $tipo_he->tH->TH_NOMBRE ?></td>
                                        <?php for ($i=0; $i < ($tipo_he->OC_CANTIDAD * $model->AS_CANTIDAD); $i++) {  ?>
                                            <?php /*if ($i>0) { ?>
                                                <tr>
                                            <?php } */
                                            $count++;?>

                                            <?php if ($asignados!=NULL && $flag == 0) { ?>

                                                <?php foreach ($asignados as $exist) { 
                                                    if ($exist->hE->TH_ID== $tipo_he->TH_ID) {?>
                                                        <?php if ($i>0) { ?>
                                                            <tr>
                                                        <?php } ?>
                                                        <td><?= $form->field($exist, '['.$count.']HAS_CANTIDAD')->textInput(['type' => 'number', 'class' => 'cantidad_he', 'id'=>$count, 'disabled'=>true])->label(false) ?>
                                                        </td>
                                                        <td><?= $form->field($exist, '['.$count.']HE_ID')->widget(Select2::classname(), [
                                                                'data' => ArrayHelper::map(Herramientas::find()->where(['TH_ID'=>$tipo_he->TH_ID])->all(),'HE_ID','HE_NOMBRE'),
                                                                'language' => 'es',
                                                                'options' => ['placeholder' => 'Selecionar '.$tipo_he->tH->TH_NOMBRE, 'class'=>'idhe', 'contador'=>$count, 'disabled'=>true],
                                                                'pluginOptions' => [
                                                                    'allowClear' => true
                                                                ],
                                                            ])->label(false);
                                                            ?>
                                                        </td>
                                            <td><?php echo ($exist->hE->HE_COSTOUNIDAD * $exist->HAS_CANTIDAD) ?></td>
                                                <?php   $i++;
                                                        $count++;
                                                    }?>

                                                <?php }
                                                $flag=1; ?>

                                            <?php }else{
                                                    $flag=1;
                                                }
                                                if($flag==1){ ?>
                                                    <?php if ($i>0) { ?>
                                                        <tr>
                                                    <?php } ?>
                                                    <td><?= $form->field($he, '['.$count.']HAS_CANTIDAD')->textInput(['type' => 'number', 'class' => 'cantidad_he', 'id'=>$count, 'disabled'=>true])->label(false) ?>
                                                    </td>
                                                    <td><?= $form->field($he, '['.$count.']HE_ID')->widget(Select2::classname(), [
                                                            'data' => ArrayHelper::map(Herramientas::find()->where(['TH_ID'=>$tipo_he->TH_ID])->all(),'HE_ID','HE_NOMBRE'),
                                                            'language' => 'es',
                                                            'options' => ['placeholder' => 'Selecionar '.$tipo_he->tH->TH_NOMBRE, 'class'=>'idhe', 'contador'=>$count],
                                                            'pluginOptions' => [
                                                                'allowClear' => true
                                                            ],
                                                        ])->label(false);
                                                        ?>
                                                    </td>
                                            <?php } ?>
                                            <td>0</td>

                                        <?php } ?>
                                <?php break;
                                    } ?>
                                    </tr>
                        </tbody>
                            <?php } ?>
                    </table>
                <?php /*
                <div class="col-md-4">
                    <table class="table">
                        <tr class="bg-orange">
                            <th>N°</th>
                            <th>Herramientas</th>
                        </tr>
                        <tbody class="table table-bordered">
                            <?php foreach ($herramientas as $he){ ?>
                                <tr>
                                    <td><?= $he->OC_CANTIDAD ?></td>
                                    <td><?= $he->tH->TH_NOMBRE ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                
                <div class="col-md-4">
                    <table class="table">
                        <tr class="bg-orange">
                                <th>N°</th>
                                <th>Obreros</th>
                        </tr>
                        <tbody class="table table-bordered">
                            <?php foreach ($obreros as $ob){ ?>
                                <tr>
                                    <td><?= $ob->RE_CANTIDAD ?></td>
                                    <td><?= $ob->tOB->TOB_NOMBRE ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                */ ?>



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
        if(flag!=''){
            $(numeric).attr('value',1);
            $(numeric).attr('disabled',false);
        }else{
            $(numeric).attr('value',null);
            $(numeric).attr('disabled',true);
        }

        var costo_actual = $(this).parent().parent().parent().children()[2];
        if(flag!=''){
            $.get('index.php?r=act-sact-asigna/get-costo-he',{ id : flag }, function(data){
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

