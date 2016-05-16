<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ContratoObreroSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contrato-obrero-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'COO_ID') ?>

    <?= $form->field($model, 'PE_RUT') ?>

    <?= $form->field($model, 'COO_FECHA') ?>

    <?= $form->field($model, 'COO_ESTADO') ?>

    <?= $form->field($model, 'COO_SUELDO') ?>

    <?php // echo $form->field($model, 'COO_HORAS') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
