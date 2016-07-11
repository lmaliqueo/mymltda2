<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Cargo;

use kartik\select2\Select2;

use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Persona */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="persona-form">

    <?php $form = ActiveForm::begin(); ?>


            
    <table class="table table-striped">
        <tr>
            <?php if ($ult_sueldo!=NULL) { ?>
                <th>Actual: </th>
                <th class="text-blue">$ <?= $ult_sueldo->SU_CANTIDAD ?></th>
            <?php }else{ ?>
                <th>Actual: </th>
                <td><span class="not-set">Sin sueldo</span></td>
            <?php } ?>
        </tr>
        <tr>
            <th>Nuevo: </th>
            <td><?= $form->field($model, 'SU_CANTIDAD')->textInput(['maxlength' => true, 'min'=>'0', 'type' => 'number', 'class'=>'input-group-sm'])->label(false) ?></td>
        </tr>
    </table>


    <div class="form-group no-margin">
        <?= Html::submitButton($model->isNewRecord ? 'Ingresar' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
