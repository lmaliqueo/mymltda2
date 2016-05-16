<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use app\models\Materiales;
use app\models\SactMatConsume;

/* @var $this yii\web\View */
/* @var $model app\models\Subactividades */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subactividades-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <?= $form->field($model, 'SACT_NOMBRE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SACT_DESCRIPCION')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'SACT_COSTO')->textInput() ?>



    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Materiales</h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 10, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $subact_tiene[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'MA_ID',
                    'CONS_CANTMATERIAL',
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($subact_tiene as $i => $subact_tiene): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Material</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $subact_tiene->isNewRecord) {
                                echo Html::activeHiddenInput($subact_tiene, "[{$i}]id");
                            }
                        ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($subact_tiene, "[{$i}]CONS_CANTMATERIAL")->textInput(['maxlength' => true]) ?>


                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($subact_tiene, "[{$i}]MA_ID")->dropDownList(
                                ArrayHelper::map(Materiales::find()->all(),'MA_ID','MA_NOMBRE'),
                                ['prompt'=>'Selecciona un material']
                                )  ?>
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
