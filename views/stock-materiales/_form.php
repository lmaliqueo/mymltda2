<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StockMateriales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="stock-materiales-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'OT_ID')->textInput() ?>

    <?= $form->field($model, 'MA_ID')->textInput() ?>

    <?= $form->field($model, 'SM_CANTIDAD')->textInput() ?>

    <?= $form->field($model, 'SM_ESTADO')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
