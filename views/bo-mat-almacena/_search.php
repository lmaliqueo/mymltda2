<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BoMatAlmacenaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bo-mat-almacena-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'AL_ID') ?>

    <?= $form->field($model, 'BO_ID') ?>

    <?= $form->field($model, 'MA_ID') ?>

    <?= $form->field($model, 'AL_CANTMATERIALES') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
