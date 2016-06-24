<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use dosamigos\datepicker\DateRangePicker;

/* @var $this yii\web\View */
/* @var $model app\models\OrdenTrabajo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orden-trabajo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'OT_NOMBRE')->textInput(['maxlength' => true]) ?>

    <?php /* $form->field($model, 'OT_TIPO')->textInput(['maxlength' => true]) */ ?>



<label class="control-label">Fecha</label>
<?= $form->field($model, 'OT_FECHA_INICIO')->widget(DateRangePicker::className(), [
    'attributeTo' => 'OT_FECHA_TERMINO', 
    'language' => 'es',
    'clientOptions' => [
        'autoclose' => true,
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true,
            'startDate'=>$proyecto->PRO_FECHA_INICIO
    ]
])->label(false);?>

<?php /*
<?= $form->field($model, 'OT_FECHA_INICIO')->widget(
    DatePicker::className(), [
        // inline too, not bad
        'inline' => false, 
         // modify template for custom rendering
        //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'language' => 'es',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
]);?>

<?= $form->field($model, 'OT_FECHA_TERMINO')->widget(
    DatePicker::className(), [
        // inline too, not bad
         'inline' => false, 
         // modify template for custom rendering
        //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'language' => 'es',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
]);?>

*/ ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
