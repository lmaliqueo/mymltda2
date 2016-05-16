<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AsignaTiene */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asigna-tiene-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'AS_ID')->textInput() ?>

    <?= $form->field($model, 'EP_ID')->textInput() ?>

    <?= $form->field($model, 'AT_CANTIDAD')->textInput() ?>

    <?= $form->field($model, 'AT_COSTO_EP')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
