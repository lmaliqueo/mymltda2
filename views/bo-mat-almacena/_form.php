<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BoMatAlmacena */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bo-mat-almacena-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'BO_ID')->textInput() ?>

    <?= $form->field($model, 'MA_ID')->textInput() ?>

    <?= $form->field($model, 'AL_CANTMATERIALES')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
