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

<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'HE_ID') ?>
        <?= $form->field($model, 'HE_DESCRIPCION') ?>
        <?= $form->field($model, 'BO_ID') ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'TH_ID') ?>
        <?= $form->field($model, 'HE_ESTADO') ?>
        <?= $form->field($model, 'PROV_ID') ?>
    </div>
</div>





    <?php // $form->field($model, 'HE_COSTOUNIDAD') ?>

    <div class="form-group">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
        <?php // Html::resetButton('Quitar Filtro', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
