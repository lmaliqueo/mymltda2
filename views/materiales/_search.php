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

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'MA_ID') ?>
        </div>
        <div class="col-md-8">
            <?= $form->field($model, 'TMA_ID') ?>
        </div>
    </div>


    <?= $form->field($model, 'MA_NOMBRE') ?>

    <?php // $form->field($model, 'MA_UNIDAD') ?>

    <?php // echo $form->field($model, 'MA_MEDIDA') ?>

    <?php //echo $form->field($model, 'MA_COSTOUNIDAD') ?>

    <div class="form-group">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
        <?php // Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
