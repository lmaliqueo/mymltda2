<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OrdenTrabajoTrabajo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orden-trabajo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'OT_ID') ?>

    <?= $form->field($model, 'PRO_ID') ?>

    <?= $form->field($model, 'OT_NOMBRE') ?>

    <?= $form->field($model, 'OT_TIPO') ?>

    <?= $form->field($model, 'OT_FECHA_INICIO') ?>

    <?php // echo $form->field($model, 'OT_FECHA_TERMINO') ?>

    <?php // echo $form->field($model, 'OT_ESTADO') ?>

    <?php // echo $form->field($model, 'OT_COSTO_TOTAL') ?>

    <?php // echo $form->field($model, 'OT_INFORME') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
