<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TransaccionMaterialesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaccion-materiales-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'TM_ID') ?>

    <?= $form->field($model, 'SM_ID') ?>

    <?= $form->field($model, 'TM_FECHACOMPRA') ?>

    <?= $form->field($model, 'TM_PRECIO') ?>

    <?= $form->field($model, 'TM_CANTIDAD') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
