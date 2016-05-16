<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GastosGenerales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gastos-generales-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'GG_TIPO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'GG_DESCRIPCION')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'GG_COSTO')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
