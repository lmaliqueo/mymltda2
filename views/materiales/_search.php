<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MaterialesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="materiales-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'MA_ID') ?>

    <?= $form->field($model, 'MA_NOMBRE') ?>

    <?= $form->field($model, 'MA_CANTIDADTOTAL') ?>

    <?= $form->field($model, 'MA_UNIDAD') ?>

    <?= $form->field($model, 'MA_MEDIDA') ?>

    <?php // echo $form->field($model, 'MA_TIPOMATERIALES') ?>

    <?php // echo $form->field($model, 'MA_COSTOUNIDAD') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
