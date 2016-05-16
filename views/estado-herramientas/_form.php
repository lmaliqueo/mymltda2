<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EstadoHerramientas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estado-herramientas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'EH_NOMBREESTADO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EH_DESCRIPCION')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
