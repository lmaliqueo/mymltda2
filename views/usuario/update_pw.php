<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Cargo;
use yii\helpers\ArrayHelper;

use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>
<br>
<div class="usuario-form">
    <?php $form = ActiveForm::begin(); ?>


                <?= $form->field($model, 'US_USERNAME')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'US_PASSWORD')->passwordInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'US_EMAIL')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'US_TIPO')->hiddenInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'US_DESCRIPCION')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Guardar Contraseña' : 'Guardar Usuario', ['class' => $model->isNewRecord ? 'btn btn-flat btn-default bg-green' : 'btn btn-flat btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
