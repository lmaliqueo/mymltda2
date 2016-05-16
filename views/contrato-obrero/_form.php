<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ContratoObrero */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contrato-obrero-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'PE_RUT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'COO_FECHA')->textInput() ?>

    <?= $form->field($model, 'COO_ESTADO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'COO_SUELDO')->textInput() ?>

    <?= $form->field($model, 'COO_HORAS')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
