<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UsoDeMateriales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="uso-de-materiales-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'AC_ID')->textInput() ?>

    <?= $form->field($model, 'UM_CANTIDADTOTA')->textInput() ?>

    <?= $form->field($model, 'UM_COSTOTOTAL')->textInput() ?>

    <?= $form->field($model, 'UM_FECHA')->textInput() ?>

    <?= $form->field($model, 'UM_ESTADO')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
