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








            <div class="row">
                <div class="col-md-6">
                    <table class="table">
                        <tr class="bg-green">
                            <th>Total</th>
                            <th>Tipo</th>
                            <th>Cantidad</th>
                            <th>Herramientas</th>
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
                                                        <td><?= $form->field($exist, '['.$count.']HAS_CANTIDAD')->textInput(['type' => 'number', 'class' => 'cantidad_he', 'id'=>$count])->label(false) ?>
                                                        </td>
                                                        <td><?= $form->field($exist, '['.$count.']HE_ID')->widget(Select2::classname(), [
                                                                'data' => ArrayHelper::map(Herramientas::find()->where(['TH_ID'=>$tipo_he->TH_ID])->all(),'HE_ID','HE_NOMBRE'),
                                                                'language' => 'es',
                                                                'options' => ['placeholder' => 'Selecionar '.$tipo_he->tH->TH_NOMBRE, 'class'=>'idhe', 'contador'=>$count],
                                                                'pluginOptions' => [
                                                                    'allowClear' => true
                                                                ],
                                                            ])->label(false);
                                                            ?>
                                                        </td>
                                                <?php   $i++;
                                                        $count++;
                                                    }?>

                                                <?php }
                                                $flag=1; ?>

                                            <?php }
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

                                        <?php } ?>
                                <?php break;
                                    } ?>
                                    </tr>
                        </tbody>
                            <?php } ?>
                    </table>
                </div>
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
            </div>



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
            
    });

});


    
JS;
$this->registerJs($script);
?>

