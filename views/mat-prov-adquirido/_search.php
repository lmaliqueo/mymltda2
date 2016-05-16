<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MatProvAdquiridoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mat-prov-adquirido-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'AD_ID') ?>

    <?= $form->field($model, 'PROV_ID') ?>

    <?= $form->field($model, 'MA_ID') ?>

    <?= $form->field($model, 'TM_ID') ?>


    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
