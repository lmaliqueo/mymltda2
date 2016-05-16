<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EstadoHerramientasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estado-herramientas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'EH_ID') ?>

    <?= $form->field($model, 'EH_NOMBREESTADO') ?>

    <?= $form->field($model, 'EH_DESCRIPCION') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
