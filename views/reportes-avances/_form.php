<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ReportesAvances */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reportes-avances-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'RA_TITULO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RA_DESCRIPCION')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'RA_FECHA')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
