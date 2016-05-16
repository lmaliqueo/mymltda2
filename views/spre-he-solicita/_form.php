<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SpreHeSolicita */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="spre-he-solicita-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'SPRE_ID')->textInput() ?>

    <?= $form->field($model, 'HE_ID')->textInput() ?>

    <?= $form->field($model, 'SOLI_CANTIDAD')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
