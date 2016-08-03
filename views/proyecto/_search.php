<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProyectoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proyecto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>


<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'PRO_NOMBRE')->textInput(['class'=>'input-sm form-control']) ?>
        <?= $form->field($model, 'PRO_ESTADO')->textInput(['class'=>'input-sm form-control']) ?>

        <?php // $form->field($model, 'PRO_FECHA_INICIO') ?>



    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'EMP_RUT')->textInput(['class'=>'input-sm form-control']) ?>
        <?= $form->field($model, 'COM_ID')->textInput(['class'=>'input-sm form-control']) ?>
        <?php // $form->field($model, 'PRO_FECHA_FINAL') ?>
    </div>
</div>

    <?php // $form->field($model, 'PRO_ID') ?>
    <?php // echo $form->field($model, 'PRO_MONTOESTIMADO') ?>

    <?php // echo $form->field($model, 'PRO_JUSTIFICACIONMONTO') ?>

    <?php // echo $form->field($model, 'PRO_OBSERVACIONES') ?>

    <?php // echo $form->field($model, 'PRO_ESTADOCONTRATO') ?>

    <?php // echo $form->field($model, 'PRO_DESCRIPCION') ?>

    <?php // echo $form->field($model, 'PRO_COSTO_TOTAL') ?>


    <?php // echo $form->field($model, 'PRO_INFORME') ?>


    <div class="form-group">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
        <?php // Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
