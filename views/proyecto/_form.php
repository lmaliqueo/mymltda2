<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\models\Comuna;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Proyecto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proyecto-form">


<div class="row">
<div class="col-md-6">

<div class="box box-primary">
    <div class="box-header with-border">
            <h3 class="box-title">Proyecto</h3>
    </div>
    <div class="box-body">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'PRO_NOMBRE')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'PRO_FECHA_INICIO')->widget(
                DatePicker::className(), [
                    // inline too, not bad
                     'inline' => false, 
                    'language' => 'es',
                     // modify template for custom rendering
                    //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
            ]);?>

            <?= $form->field($model, 'PRO_OBSERVACIONES')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'COM_ID')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Comuna::find()->all(),'COM_ID','COM_NOMBRE','cIU.CIU_NOMBRE'),
                'language' => 'es',
                'options' => ['placeholder' => 'Selecionar comuna'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>

            <?= $form->field($model, 'PRO_DIRECCION')->textInput(['maxlength' => true]) ?>

        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="box box-primary">
        <div class="box-header with-border">
                <h3 class="box-title">Empresa Cliente</h3>
        </div>
        <div class="box-body">
            <?= $form->field($cliente, 'EMP_RUT')->textInput(['maxlength' => true]) ?>

            <?= $form->field($cliente, 'EMP_NOMBRE')->textInput(['maxlength' => true]) ?>

            <?= $form->field($cliente, 'EMP_RAZON')->textInput(['maxlength' => true]) ?>

            <?= $form->field($cliente, 'EMP_RUBRO')->textInput(['maxlength' => true]) ?>

            <?= $form->field($cliente, 'COM_ID')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Comuna::find()->all(),'COM_ID','COM_NOMBRE','cIU.CIU_NOMBRE'),
                'language' => 'es',
                'options' => ['placeholder' => 'Selecionar comuna'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>

            <?= $form->field($cliente, 'EMP_DIRECCION')->textInput(['maxlength' => true]) ?>

            <?= $form->field($cliente, 'EMP_TELEFONO')->textInput() ?>
        </div>
    </div>
</div>
</div>        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Generar' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
