<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SueldoObreroSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sueldo-obrero-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'SU_ID') ?>

    <?= $form->field($model, 'COO_ID') ?>

    <?= $form->field($model, 'SU_CANTIDAD') ?>

    <?= $form->field($model, 'SU_FECHA') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
