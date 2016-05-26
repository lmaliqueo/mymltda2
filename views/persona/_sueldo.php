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


    <div class="row">
        <div class="col-md-6">
                <label class="control-label">Actual</label>
            <?php if ($ult_sueldo!=NULL) { ?>
                <h4 class="text-blue"><strong>$<?= $ult_sueldo->SU_CANTIDAD ?></strong></h4> 
                <p><span class="glyphicon glyphicon glyphicon-calendar" aria-hidden="true"></span> <?= $ult_sueldo->SU_FECHA ?></p>
            <?php }else{ ?>
                <p>sin sueldo</p>
            <?php } ?>
        </div>
        <div class="col-md-6">
            <label class="control-label">Nuevo</label> 
            <?= $form->field($model, 'SU_CANTIDAD')->textInput(['maxlength' => true, 'min'=>'0', 'type' => 'number'])->label(false) ?>
        </div>
    </div>

<div class="modal-footer">
    <div class="form-group no-margin">
        <?= Html::submitButton($model->isNewRecord ? 'Ingresar' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
</div>
    <?php ActiveForm::end(); ?>

</div>
