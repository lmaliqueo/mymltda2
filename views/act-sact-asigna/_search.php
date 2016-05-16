<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ActSactAsignaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="act-sact-asigna-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'AS_ID') ?>

    <?= $form->field($model, 'AC_ID') ?>

    <?= $form->field($model, 'SACT_ID') ?>

    <?= $form->field($model, 'AS_CANTIDAD') ?>

    <?= $form->field($model, 'AS_COSTOTOTAL') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
