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


<div class="box box-solid">
    <div class="box-body">
        <div class="box-header with-border">
            <h3 class="no-margin">
                Proyecto
            </h3>
            <span class="box-tools">
                <?= Html::submitButton($model->isNewRecord ? 'Crear Proyecto' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success btn-flat' : 'btn btn-primary']) ?>
            </span>
        </div>
        <div class="box box-primary">
            <div class="box-body">
                <?php $form = ActiveForm::begin(); ?>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'PRO_NOMBRE')->textInput(['maxlength' => true, ]) ?>
                        <?= $form->field($model, 'COM_ID')->widget(Select2::classname(), [
                            'data' => ArrayHelper::map(Comuna::find()->all(),'COM_ID','COM_NOMBRE','cIU.CIU_NOMBRE'),
                            'language' => 'es',
                            'options' => ['placeholder' => 'Selecionar comuna'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);
                        ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'PRO_FECHA_INICIO')->widget(
                            DatePicker::className(), [
                                // inline too, not bad
                                 'inline' => false, 
                                'language' => 'es',
                                 // modify template for custom rendering
                                //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                                'clientOptions' => [
                                    'autoclose' => true,
                                    'format' => 'yyyy-mm-dd',
                                    'todayHighlight' => true,
                                    'startDate'=>date('Y-m-d')
                                ]
                        ]);?>
                        <?= $form->field($model, 'PRO_DIRECCION')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>


                <?= $form->field($model, 'PRO_OBSERVACIONES')->textarea(['rows' => 6]) ?>



            </div>
        </div>
        <br>
    <h3 class="no-margin">Empresa Cliente</h3>
    </div>
    <div class="box-footer">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($cliente, 'EMP_RUT')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($cliente, 'EMP_NOMBRE')->textInput(['maxlength' => true])->label('Nombre empresa') ?>
                        <?= $form->field($cliente, 'COM_ID')->widget(Select2::classname(), [
                            'data' => ArrayHelper::map(Comuna::find()->all(),'COM_ID','COM_NOMBRE','cIU.CIU_NOMBRE'),
                            'language' => 'es',
                            'options' => ['placeholder' => 'Selecionar comuna'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);
                        ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($cliente, 'EMP_RAZON')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($cliente, 'EMP_TELEFONO')->textInput() ?>
                        <?php // $form->field($cliente, 'EMP_RUBRO')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($cliente, 'EMP_DIRECCION')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>






<div class="row">
<div class="col-md-6">

</div>
<div class="col-md-6">
</div>
</div>        <div class="form-group">
        </div>

    <?php ActiveForm::end(); ?>

</div>
