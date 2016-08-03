<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GastosGenerales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gastos-generales-form">

    <?php $form = ActiveForm::begin(); ?>

<div class="row">
    <div class="col-md-6">
	    <?= $form->field($model, 'GG_TIPO')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-6">
	    <?= $form->field($model, 'GG_COSTO')->textInput(['type'=>'number', 'template'=>'  <span class="input-group-addon">$</span> {input} {error}']) ?>
    </div>
</div>


    <?= $form->field($model, 'GG_DESCRIPCION')->textInput(['maxlength' => true]) ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
