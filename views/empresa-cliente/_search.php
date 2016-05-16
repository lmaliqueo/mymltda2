<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EmpresaClienteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="empresa-cliente-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'EMP_RUT') ?>

    <?= $form->field($model, 'COM_ID') ?>

    <?= $form->field($model, 'EMP_RAZON') ?>

    <?= $form->field($model, 'EMP_NOMBRE') ?>

    <?= $form->field($model, 'EMP_RUBRO') ?>

    <?php // echo $form->field($model, 'EMP_DIRECCION') ?>

    <?php // echo $form->field($model, 'EMP_TELEFONO') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
