<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SubactividadesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subactividades-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'SACT_ID') ?>

    <?= $form->field($model, 'SACT_NOMBRE') ?>

    <?= $form->field($model, 'SACT_DESCRIPCION') ?>

    <?= $form->field($model, 'SACT_COSTO') ?>

    <?= $form->field($model, 'SACT_TIPOMEDICION') ?>

    <?php // echo $form->field($model, 'SACT_CANTIDAD') ?>

    <?php // echo $form->field($model, 'SACT_CANTIDADMANODEOBRA') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
