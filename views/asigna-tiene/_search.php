<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AsignaTieneSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asigna-tiene-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'AT_ID') ?>

    <?= $form->field($model, 'AS_ID') ?>

    <?= $form->field($model, 'EP_ID') ?>

    <?= $form->field($model, 'AT_CANTIDAD') ?>

    <?= $form->field($model, 'AT_COSTO_EP') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
