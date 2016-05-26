<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Cargo;

use kartik\select2\Select2;

use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Persona */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="persona-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'PE_RUT')->textInput(['maxlength' => true]) ?>


<?= $form->field($model, 'CA_ID')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Cargo::find()->all(),'CA_ID','CA_NOMBRECARGO'),
    'language' => 'es',
    'options' => ['placeholder' => 'Selecionar cargo', 'id'=>'sactID'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]);
?>

    <?= $form->field($model, 'PE_NOMBRES')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PE_APELLIDOPAT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PE_APELLIDOMAT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PE_TELEFONO')->textInput() ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Ingresar' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
