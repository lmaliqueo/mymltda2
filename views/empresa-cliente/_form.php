<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EmpresaCliente */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="empresa-cliente-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'EMP_RUT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'COM_ID')->textInput() ?>

    <?= $form->field($model, 'EMP_RAZON')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EMP_NOMBRE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EMP_RUBRO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EMP_DIRECCION')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EMP_TELEFONO')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
