<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HerramientasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="herramientas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'HE_ID') ?>

    <?= $form->field($model, 'BO_ID') ?>

    <?= $form->field($model, 'HE_NOMBRE') ?>

    <?= $form->field($model, 'HE_CANT') ?>

    <?= $form->field($model, 'HE_COSTOUNIDAD') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
