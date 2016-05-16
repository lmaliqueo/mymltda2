<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SolicitudPrestamoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="solicitud-prestamo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'SPRE_ID') ?>

    <?= $form->field($model, 'PE_RUT') ?>

    <?= $form->field($model, 'SPRE_TITULO') ?>

    <?= $form->field($model, 'SPRE_FECHA') ?>

    <?= $form->field($model, 'SPRE_ESTADO') ?>

    <?php // echo $form->field($model, 'SPRE_TEXTO') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
