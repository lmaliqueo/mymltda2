<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Bodegas;
use app\models\TipoHerramienta;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Herramientas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="herramientas-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'HE_NOMBRE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TH_ID')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(TipoHerramienta::find()->all(),'TH_ID','TH_NOMBRE'),
        'language' => 'es',
        'options' => ['placeholder' => 'Selecionar tipo de herramienta'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
    
    <?= $form->field($model, 'BO_ID')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Bodegas::find()->all(),'BO_ID','BO_NOMBRE'),
        'language' => 'es',
        'options' => ['placeholder' => 'Selecionar Bodega'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>






    <?= $form->field($model, 'HE_CANT')->textInput() ?>

    <?= $form->field($model, 'HE_COSTOUNIDAD')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
