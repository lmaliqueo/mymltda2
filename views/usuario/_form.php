<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'PE_RUT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'US_USSERNAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'US_PASSWORD')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'US_EMAIL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'US_TIPO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'US_DESCRIPCION')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
