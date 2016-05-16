<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\OrdenTrabajo;
use dosamigos\datepicker\DatePicker;
use dosamigos\datepicker\DateRangePicker;


/* @var $this yii\web\View */
/* @var $model app\models\Actividades */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="actividades-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'AC_NOMBRE')->textInput(['maxlength' => true]) ?>


<label class="control-label">Fecha</label>

<?= $form->field($model, 'AC_FECHA_INICIO')->widget(DateRangePicker::className(), [
    'attributeTo' => 'AC_FECHA_TERMINO', 
    'language' => 'es',
    'clientOptions' => [
        'autoclose' => false,
            'format' => 'yyyy-mm-dd'
    ]
])->label(false);?>

<?php /*

<?= $form->field($model, 'AC_FECHA_INICIO')->widget(
    DatePicker::className(), [
        // inline too, not bad
         'inline' => false, 
         // modify template for custom rendering
        //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
]);?>

<?= $form->field($model, 'AC_FECHA_TERMINO')->widget(
    DatePicker::className(), [
        // inline too, not bad
         'inline' => false, 
         // modify template for custom rendering
        //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
]);?>


*/ ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>



</div>
