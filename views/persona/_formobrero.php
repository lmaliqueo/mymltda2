<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Proyecto;
use app\models\TipoObrero;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Persona */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="persona-form">

    <?php $form = ActiveForm::begin(); ?>

<div class="row">
    <div class="col-md-7">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h4 class="box-title">Datos Obrero</h4>
            </div>
            <div class="box-body">
                <?= $form->field($model, 'PE_NOMBRES')->textInput(['maxlength' => true]) ?>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'PE_APELLIDOPAT')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'PE_APELLIDOMAT')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
                <?= $form->field($model, 'PE_RUT')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'PE_TELEFONO')->textInput(['type'=>'number']) ?>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h4 class="box-title">Contrato</h4>
            </div>
            <div class="box-body">
                <?= $form->field($contrato, 'PRO_ID')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(Proyecto::find()->where(['not in','PRO_ESTADO','Finalizado'])->all(),'PRO_ID','PRO_NOMBRE'),
                    'language' => 'es',
                    'options' => ['placeholder' => 'Selecionar proyecto', 'id'=>'sactID'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>

                <?= $form->field($contrato, 'TOB_ID')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(TipoObrero::find()->all(),'TOB_ID','TOB_NOMBRE'),
                    'language' => 'es',
                    'options' => ['placeholder' => 'Selecionar tipo de obrero'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>
                    
                <?= $form->field($sueldo, 'SU_CANTIDAD')->textInput(['type'=>'number']) ?>
            </div>
        </div>
    </div>
</div>





    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Ingresar' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
