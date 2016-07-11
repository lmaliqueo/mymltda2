<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Proyecto;
use app\models\TipoObrero;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Persona */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="persona-form">

    <?php $form = ActiveForm::begin(); ?>


        <div class="box box-primary">
            <div class="box-header with-border">
                <h4 class="box-title">Datos Obrero</h4>
            </div>
            <div class="box-body no-padding">
                <table class="table table-striped">
                    <tr>
                        <th>RUT:</th>
                        <td><?= $obrero->PE_RUT ?></td>
                    </tr>
                    <tr>
                        <th>Nombre:</th>
                        <td><?php echo $obrero->PE_NOMBRES.' '.$obrero->PE_APELLIDOPAT.' '.$obrero->PE_APELLIDOMAT; ?></td>
                    </tr>
                </table>
            </div>
        </div>

<div class="box box-primary">
    <div class="box-header with-border">
        <h4 class="box-title">Contrato</h4>
    </div>
    <dib class="box-body">
        <div class="col-md-12">
            <?= $form->field($contrato, 'PRO_ID')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Proyecto::find()->where(['not in','PRO_ESTADO','Finalizado'])->all(),'PRO_ID','PRO_NOMBRE'),
                'language' => 'es',
                'options' => ['placeholder' => 'Selecionar proyecto'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>

            <?= $form->field($contrato, 'TOB_ID')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(TipoObrero::find()->all(),'TOB_ID','TOB_NOMBRE'),
                'language' => 'es',
                'options' => ['placeholder' => 'Selecionar tipo de obrero', 'id'=>'tipo_ob'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
                
            <?= $form->field($sueldo, 'SU_CANTIDAD')->textInput(['type'=>'number']) ?>

        </div>
    </dib>
</div>

    <div class="form-group">
        <?= Html::submitButton($contrato->isNewRecord ? 'Ingresar' : 'Guardar', ['class' => $contrato->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
