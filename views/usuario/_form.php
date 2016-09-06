<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Cargo;
use yii\helpers\ArrayHelper;

use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>
<br>
<div class="usuario-form">
    <?php $form = ActiveForm::begin(); ?>

<div class="box box-solid">
    <div class="box-header">
        <h3 class="no-margin">
            Crear Nuevo Usuario
        </h3>
        <span class="box-tools">
            <?= Html::submitButton($model->isNewRecord ? 'Ingresar Usuario' : 'Guardar Usuario', ['class' => $model->isNewRecord ? 'btn btn-flat btn-default bg-green' : 'btn btn-flat btn-primary']) ?>

        </span>
    </div>
    <div class="box-body">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h4 class="box-title">
                    Datos de Usuario
                </h4>
            </div>
            <div class="box-body">
                <?= $form->field($model, 'US_USERNAME')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'US_PASSWORD')->passwordInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'US_EMAIL')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'US_TIPO')->hiddenInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'US_DESCRIPCION')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h4 class="box-title">
                    Datos Personales
                </h4>
            </div>
            <div class="box-body">
                <?= $form->field($persona, 'PE_RUT')->textInput(['maxlength' => true]) ?>

                <?= $form->field($persona, 'CA_ID')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(Cargo::find()->all(),'CA_ID','CA_NOMBRECARGO'),
                    'language' => 'es',
                    'options' => ['placeholder' => 'Selecionar cargo', 'id'=>'sactID'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>

                <?= $form->field($persona, 'PE_NOMBRES')->textInput(['maxlength' => true]) ?>

                <?= $form->field($persona, 'PE_APELLIDOPAT')->textInput(['maxlength' => true]) ?>

                <?= $form->field($persona, 'PE_APELLIDOMAT')->textInput(['maxlength' => true]) ?>

                <?= $form->field($persona, 'PE_TELEFONO')->textInput() ?>
            </div>
        </div>
    </div>
</div>




    <div class="form-group">
    </div>

    <?php ActiveForm::end(); ?>

</div>
