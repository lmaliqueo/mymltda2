<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SactMatConsume */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sact-mat-consume-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'MA_ID')->textInput() ?>

    <?= $form->field($model, 'SACT_ID')->textInput() ?>

    <?= $form->field($model, 'UM_ID')->textInput() ?>

    <?= $form->field($model, 'CONS_CANTMATERIAL')->textInput() ?>

    <?= $form->field($model, 'CONS_COSTO')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
