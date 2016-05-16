<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LicitacionPublicaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="licitacion-publica-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'LI_ID') ?>

    <?= $form->field($model, 'LI_ORGANIZACIONRESPONSABLE') ?>

    <?= $form->field($model, 'LI_NOMBRELICITACION') ?>

    <?= $form->field($model, 'LI_DESCRIPCION') ?>

    <?= $form->field($model, 'LI_DETALLESLICITACION') ?>

    <?php // echo $form->field($model, 'LI_FECHAPOSTULACION') ?>

    <?php // echo $form->field($model, 'LI_ESTADO') ?>

    <?php // echo $form->field($model, 'LI_CIUDAD') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
