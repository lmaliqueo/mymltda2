<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Proveedor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proveedor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'PROV_NOMBRE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PROV_CIUDAD')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PROV_CALLE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PROV_RAZONSOCIAL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PROV_MUNICIPIO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PROV_CODIGOPOSTAL')->textInput() ?>

    <?= $form->field($model, 'PROV_FAX')->textInput() ?>

    <?= $form->field($model, 'PROV_EMAIL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PROV_CONTACTO')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
