<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BodegasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bodegas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'BO_ID') ?>

    <?= $form->field($model, 'BO_NOMBRE') ?>

    <?= $form->field($model, 'BO_DIRECCION') ?>

    <?= $form->field($model, 'BO_CANTIDADHERRAMIENTAS') ?>

    <?= $form->field($model, 'BO_CANTIDADMATERIALES') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
