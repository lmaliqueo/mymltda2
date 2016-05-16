<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TipoObreroSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipo-obrero-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'TOB_ID') ?>

    <?= $form->field($model, 'TOB_NOMBRE') ?>

    <?= $form->field($model, 'TOB_DESCRIPCION') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
