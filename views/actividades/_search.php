<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ActividadesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="actividades-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'AC_ID') ?>

    <?= $form->field($model, 'OT_ID') ?>

    <?= $form->field($model, 'AC_NOMBRE') ?>

    <?= $form->field($model, 'AC_FECHA_INCIO') ?>

    <?= $form->field($model, 'AC_FECHA_TERMINO') ?>

    <?php // echo $form->field($model, 'AC_COSTO_TOTAL') ?>

    <?php // echo $form->field($model, 'AC_ESTADO') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
