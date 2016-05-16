<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EstadoPagoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estado-pago-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'EP_ID') ?>

    <?= $form->field($model, 'EP_NUMEROEP') ?>

    <?= $form->field($model, 'EP_FECHA') ?>

    <?= $form->field($model, 'EP_PERIODO') ?>

    <?= $form->field($model, 'EP_TOTALEP') ?>

    <?php // echo $form->field($model, 'EP_FACTURA') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
