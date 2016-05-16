<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use app\models\Materiales;
use app\models\SactMatConsume;

/* @var $this yii\web\View */
/* @var $model app\models\Subactividades */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subactividades-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'SACT_NOMBRE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SACT_DESCRIPCION')->textarea(['rows' => 6]) ?>





    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Asignar Recursos' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
