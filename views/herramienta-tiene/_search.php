<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HerramientaTieneSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="herramienta-tiene-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'HT_ID') ?>

    <?= $form->field($model, 'EH_ID') ?>

    <?= $form->field($model, 'HE_ID') ?>

    <?= $form->field($model, 'HT_CANTHEESTADO') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
