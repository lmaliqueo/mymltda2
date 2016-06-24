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
        <?= $form->field($model, 'PE_NOMBRES')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'PE_APELLIDOPAT')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'PE_APELLIDOMAT')->textInput(['maxlength' => true]) ?>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'PE_RUT')->textInput(['maxlength' => true, 'disabled'=> $model->isNewRecord ? false : true]) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'PE_TELEFONO')->textInput() ?>
    </div>
</div>




    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Registrar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
