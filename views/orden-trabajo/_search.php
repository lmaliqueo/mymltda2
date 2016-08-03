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

<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'PRO_ID')->textInput(['class'=>'input-sm form-control']) ?>

        <?= $form->field($model, 'OT_FECHA_INICIO')->textInput(['class'=>'input-sm form-control']) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'OT_NOMBRE')->textInput(['class'=>'input-sm form-control'])->label('Nombre OT') ?>

        <?= $form->field($model, 'OT_FECHA_TERMINO')->textInput(['class'=>'input-sm form-control']) ?>
    </div>
</div>
    <?php // $form->field($model, 'OT_ID') ?>


    <?php // $form->field($model, 'OT_TIPO') ?>


    <?php // echo $form->field($model, 'OT_ESTADO') ?>

    <?php // echo $form->field($model, 'OT_COSTO_TOTAL') ?>

    <?php // echo $form->field($model, 'OT_INFORME') ?>

    <div class="form-group">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
        <?php // Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
