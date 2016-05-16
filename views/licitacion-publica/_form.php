<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LicitacionPublica */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="licitacion-publica-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'LI_ORGANIZACIONRESPONSABLE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LI_NOMBRELICITACION')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LI_DESCRIPCION')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LI_DETALLESLICITACION')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'LI_FECHAPOSTULACION')->textInput() ?>

    <?= $form->field($model, 'LI_ESTADO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LI_CIUDAD')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
