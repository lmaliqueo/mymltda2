<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TransaccionMateriales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaccion-materiales-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'SM_ID')->textInput() ?>

    <?= $form->field($model, 'TM_FECHACOMPRA')->textInput() ?>

    <?= $form->field($model, 'TM_PRECIO')->textInput() ?>

    <?= $form->field($model, 'TM_CANTIDAD')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
