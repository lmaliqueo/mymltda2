<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UsoDeMaterialesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="uso-de-materiales-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'UM_ID') ?>

    <?= $form->field($model, 'AC_ID') ?>

    <?= $form->field($model, 'UM_CANTIDADTOTA') ?>

    <?= $form->field($model, 'UM_COSTOTOTAL') ?>

    <?= $form->field($model, 'UM_FECHA') ?>

    <?php // echo $form->field($model, 'UM_ESTADO') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
