<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\SpreHeSolicita;
use app\models\Herramientas;
use app\models\Persona;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\SolicitudPrestamo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="solicitud-prestamo-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <?= $form->field($model, 'PE_RUT')->dropDownList(
    ArrayHelper::map(Persona::find()->all(),'PE_RUT','PE_NOMBRES'),
    ['prompt'=>'Selecciona una persona']
    ) ?>


    <?= $form->field($model, 'SPRE_TITULO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SPRE_DESCRIPCION')->textarea(['rows' => 6]) ?>

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
                'model' => $prestamo[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'MA_ID',
                    'CONS_CANTMATERIAL',
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($prestamo as $i => $prestamo): ?>
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
                            if (! $prestamo->isNewRecord) {
                                echo Html::activeHiddenInput($prestamo, "[{$i}]id");
                            }
                        ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($prestamo, "[{$i}]SOLI_CANTIDAD")->textInput(['maxlength' => true]) ?>


                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($prestamo, "[{$i}]HE_ID")->dropDownList(
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
