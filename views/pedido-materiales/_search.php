<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PedidoMaterialesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pedido-materiales-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'PM_ID') ?>

    <?= $form->field($model, 'PRO_ID') ?>

    <?= $form->field($model, 'PM_ESTADO') ?>

    <?= $form->field($model, 'PM_DESCRIPCION') ?>

    <?= $form->field($model, 'PM_FECHA') ?>

    <?php // echo $form->field($model, 'PM_TEXTO') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
