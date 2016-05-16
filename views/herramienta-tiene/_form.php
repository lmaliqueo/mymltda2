<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HerramientaTiene */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="herramienta-tiene-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'EH_ID')->textInput() ?>

    <?= $form->field($model, 'HE_ID')->textInput() ?>

    <?= $form->field($model, 'HT_CANTHEESTADO')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
