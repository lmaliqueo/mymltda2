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

    <?= $form->field($model, 'PRO_ID') ?>

    <?= $form->field($model, 'LI_ID') ?>

    <?= $form->field($model, 'SPRO_ID') ?>

    <?= $form->field($model, 'PRO_NOMBRE') ?>

    <?= $form->field($model, 'PRO_FECHACONTRATO') ?>

    <?php // echo $form->field($model, 'PRO_DETALLESCONTRATO') ?>

    <?php // echo $form->field($model, 'PRO_FECHAINICIOPROPUESTO') ?>

    <?php // echo $form->field($model, 'PRO_FECHATERMINOPROPUESTO') ?>

    <?php // echo $form->field($model, 'PRO_TIPOCONTRATO') ?>

    <?php // echo $form->field($model, 'PRO_MONTOESTIMADO') ?>

    <?php // echo $form->field($model, 'PRO_JUSTIFICACIONMONTO') ?>

    <?php // echo $form->field($model, 'PRO_OBSERVACIONES') ?>

    <?php // echo $form->field($model, 'PRO_ESTADOCONTRATO') ?>

    <?php // echo $form->field($model, 'PRO_DESCRIPCION') ?>

    <?php // echo $form->field($model, 'PRO_COSTO_TOTAL') ?>

    <?php // echo $form->field($model, 'PRO_FECHA_INICIO') ?>

    <?php // echo $form->field($model, 'PRO_FECHA_FINAL') ?>

    <?php // echo $form->field($model, 'PRO_INFORME') ?>

    <?php // echo $form->field($model, 'PRO_ESTADO') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
