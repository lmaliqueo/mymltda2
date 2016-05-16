<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SactMatConsumeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sact-mat-consume-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'CONS_ID') ?>

    <?= $form->field($model, 'MA_ID') ?>

    <?= $form->field($model, 'SACT_ID') ?>

    <?= $form->field($model, 'UM_ID') ?>

    <?= $form->field($model, 'CONS_CANTMATERIAL') ?>

    <?php // echo $form->field($model, 'CONS_COSTO') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
