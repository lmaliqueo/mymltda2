<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StockMaterialesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="stock-materiales-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'SM_ID') ?>

    <?= $form->field($model, 'OT_ID') ?>

    <?= $form->field($model, 'MA_ID') ?>

    <?= $form->field($model, 'SM_CANTIDAD') ?>

    <?= $form->field($model, 'SM_ESTADO') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
