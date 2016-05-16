<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ReportesAvancesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reportes-avances-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'RA_ID') ?>

    <?= $form->field($model, 'OT_ID') ?>

    <?= $form->field($model, 'RA_TITULO') ?>

    <?= $form->field($model, 'RA_DESCRIPCION') ?>

    <?= $form->field($model, 'RA_FECHA') ?>

    <?php // echo $form->field($model, 'RA_TEXTO') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
