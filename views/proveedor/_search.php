<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProveedorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proveedor-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'PROV_ID') ?>

    <?= $form->field($model, 'PROV_NOMBRE') ?>

    <?= $form->field($model, 'PROV_CALLE') ?>

    <?= $form->field($model, 'PROV_RAZONSOCIAL') ?>

    <?php // echo $form->field($model, 'PROV_MUNICIPIO') ?>

    <?php // echo $form->field($model, 'PROV_CODIGOPOSTAL') ?>

    <?php // echo $form->field($model, 'PROV_FAX') ?>

    <?php // echo $form->field($model, 'PROV_EMAIL') ?>

    <?php // echo $form->field($model, 'PROV_CONTACTO') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
