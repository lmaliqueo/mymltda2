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
                <div class="col-md-8">
                    <table class="table">
                        <tr class="bg-orange">
                            <th>Cantidad</th>
                            <th>Tipo</th>
                            <th>Materiales</th>
                            <th>Costo</th>
                        </tr>
                        <tbody class="table table-bordered">
                            <?php foreach ($materiales as $count => $tipo_mat) { ?>
                                <?php foreach ($arreglo_mat as $mat){ ?>
                                    <tr>
                                        
                                        <?php /*<td><?php echo ($model->AS_CANTIDAD * $tipo_mat->CONS_CANTIDAD); ?></td>*/ ?>
                                        <td><?php echo ($model->AS_CANTIDAD * $tipo_mat->CONS_CANTIDAD); /*<?= $form->field($mat, '['.$count.']MAS_CANTIDAD')->textInput(['type' => 'number', 'class' => 'cantidad_ep', 'value'=>($model->AS_CANTIDAD * $tipo_mat->CONS_CANTIDAD)])->label(false) ?> */ ?>
                                        </td>
                                        <td><?= $tipo_mat->tMA->TMA_NOMBRE ?></td>
                                        <td><?= $form->field($mat, '['.$count.']MA_ID')->widget(Select2::classname(), [
                                                'data' => ArrayHelper::map(Materiales::find()->where(['TMA_ID'=>$tipo_mat->TMA_ID])->all(),'MA_ID','MA_NOMBRE'),
                                                'language' => 'es',
                                                'size' => Select2::SMALL,
                                                'options' => ['placeholder' => 'Selecionar material', 'class'=>'idma', 'cant'=>($model->AS_CANTIDAD * $tipo_mat->CONS_CANTIDAD)],
                                                'pluginOptions' => [
                                                    'allowClear' => true
                                                ],
                                            ])->label(false);
                                            ?>
                                        </td>
                                        <td>0</td>
                                    </tr>
                                <?php break;
                                    } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <?php /*
                <div class="col-md-6">
                    <table class="table">
                        <tr class="bg-green">
                            <th>Cantidad</th>
                            <th>Tipo</th>
                            <th>Herramientas</th>
                        </tr>
                        <tbody class="table table-bordered">
                            <?php foreach ($herramientas as $contador => $tipo_he) { ?>
                                <?php foreach ($arreglo_he as $he){ ?>
                                    <tr>
                                        <td><?= $form->field($he, '['.$contador.']HAS_CANTIDAD')->textInput(['type' => 'number', 'class' => 'cantidad_he'])->label(false) ?>
                                        </td>
                                        <td><?= $tipo_he->tH->TH_NOMBRE ?></td>
                                        <td><?= $form->field($he, '['.$contador.']HE_ID')->widget(Select2::classname(), [
                                                'data' => ArrayHelper::map(Herramientas::find()->where(['TH_ID'=>$tipo_he->TH_ID])->all(),'HE_ID','HE_NOMBRE'),
                                                'language' => 'es',
                                                'options' => ['placeholder' => 'Selecionar herramienta'],
                                                'pluginOptions' => [
                                                    'allowClear' => true
                                                ],
                                            ])->label(false);
                                            ?>
                                        </td>
                                    </tr>
                                <?php break;
                                    } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
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

    $(document).on('change', '.idma', function(e) {
        var idmat=$(this).val();
        var cantidad= $(this).attr('cant');
        var costo_actual = $(this).parent().parent().parent().children()[3];
        if(idmat!=''){
            $.get('index.php?r=act-sact-asigna/get-costo-ma',{ id : idmat }, function(data){
                var data = $.parseJSON(data);

                $(costo_actual).text(data.MA_COSTOUNIDAD * cantidad);
            })
        }else{
                $(costo_actual).text(0);
        }
    });

});


    
JS;
$this->registerJs($script);
?>

