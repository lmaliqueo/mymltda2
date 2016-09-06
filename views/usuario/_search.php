<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UsuarioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'US_ID') ?>

    <?= $form->field($model, 'PE_RUT') ?>

    <?= $form->field($model, 'US_USERNAME') ?>

    <?= $form->field($model, 'US_PASSWORD') ?>

    <?= $form->field($model, 'US_EMAIL') ?>

    <?php // echo $form->field($model, 'US_TIPO') ?>

    <?php // echo $form->field($model, 'US_DESCRIPCION') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
