<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GastosGeneralesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gastos-generales-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'GG_ID') ?>

    <?= $form->field($model, 'PRO_ID') ?>

    <?= $form->field($model, 'GG_TIPO') ?>

    <?= $form->field($model, 'GG_DESCRIPCION') ?>

    <?= $form->field($model, 'GG_COSTO') ?>

    <?php // echo $form->field($model, 'GG_TEXT') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
