<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PedidoAdjuntaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pedido-adjunta-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'PV_ID') ?>

    <?= $form->field($model, 'PM_ID') ?>

    <?= $form->field($model, 'SM_ID') ?>

    <?= $form->field($model, 'VI_CANTIDADMAT') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
