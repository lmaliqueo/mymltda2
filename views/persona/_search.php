<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PersonaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="persona-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'PE_RUT') ?>

    <?= $form->field($model, 'CA_ID') ?>

    <?= $form->field($model, 'PE_NOMBRES') ?>

    <?= $form->field($model, 'PE_APELLIDOPAT') ?>

    <?= $form->field($model, 'PE_APELLIDOMAT') ?>

    <?php // echo $form->field($model, 'PE_TELEFONO') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
