<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Proveedor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proveedor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'PROV_NOMBRE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PROV_CIUDAD')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PROV_CALLE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PROV_RAZONSOCIAL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PROV_MUNICIPIO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PROV_CODIGOPOSTAL')->textInput() ?>

    <?= $form->field($model, 'PROV_FAX')->textInput() ?>

    <?= $form->field($model, 'PROV_EMAIL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PROV_CONTACTO')->textInput() ?>


    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Herramientas</h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 10, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $agregar[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'MA_ID',
                    'CONS_CANTMATERIAL',
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($agregar as $i => $agregar): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Herramienta</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $agregar->isNewRecord) {
                                echo Html::activeHiddenInput($agregar, "[{$i}]id");
                            }
                        ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($agregar, "[{$i}]SOLI_CANTIDAD")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($agregar, "[{$i}]MA_ID")->dropDownList(
                                ArrayHelper::map(Herramientas::find()->all(),'HE_ID','HE_NOMBRE'),
                                ['prompt'=>'Selecciona una herramienta']
                                ) ?>
                            </div>
                        </div><!-- .row -->
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
