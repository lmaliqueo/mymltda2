<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SueldoObrero */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sueldo-obrero-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'COO_ID')->textInput() ?>

    <?= $form->field($model, 'SU_CANTIDAD')->textInput() ?>

    <?= $form->field($model, 'SU_FECHA')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
