<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ManodeobraTrabajan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="manodeobra-trabajan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'PE_RUT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AC_ID')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
