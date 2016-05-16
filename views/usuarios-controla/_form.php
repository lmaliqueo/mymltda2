<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UsuariosControla */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuarios-controla-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'US_ID')->textInput() ?>

    <?= $form->field($model, 'PRO_ID')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
