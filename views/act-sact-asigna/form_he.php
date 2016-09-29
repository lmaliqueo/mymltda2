<?php 

use yii\helpers\Html;
use app\models\Herramientas;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use wbraganca\dynamicform\DynamicFormWidget;

 ?>



    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_inner',
        'widgetBody' => '.container-he',
        'widgetItem' => '.he-item',
        'limit' => 4,
        'min' => 1,
        'insertButton' => '.add-he',
        'deleteButton' => '.remove-he',
        'model' => $arreglo_he[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'HE_ID',
        ],
    ]); ?>
    <table class="table ">
        <tr class="bg-gray">
            <th><?php echo ($tipo_he->OC_CANTIDAD * $model->AS_CANTIDAD).' '.$tipo_he->tH->TH_NOMBRE; ?></th>
            <th><button type="button" class="add-he btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i> Agregar herramienta</button></th>
        </tr>
    </table>

<div class="container-he"> 
    <?php foreach ($arreglo_he as $count => $he){ ?>
        <table class="table table-bordered he-item">

            <tr>
                <td style="width:27%">
                    <?= $form->field($he, "[{$contador}][{$count}]HE_ID")->dropDownList(
                        ArrayHelper::map(Herramientas::find()->where(['TH_ID'=>$tipo_he->TH_ID])->andWhere(['not in','HE_ID', $array_asignados])->all(),'HE_ID','selectHe'),
                        ['prompt'=>'Seleccione una herramienta '.$tipo_he->tH->TH_NOMBRE, 'class'=>'id_he form-control no-margin'])->label(false) ?>
                </td>
                <td class="costo_he"></td>
                <td>
                    <button type="button" class="remove-he btn btn-danger btn-xs"><span class="fa fa-minus"></span></button>
                </td>
            </tr>

        </table>

    <?php } ?>
</div>

<?php DynamicFormWidget::end(); ?>



