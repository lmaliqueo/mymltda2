<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\models\OrdenTrabajo;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DateRangePicker;

/* @var $this yii\web\View */
/* @var $model app\models\UsuariosControla */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Informe inventario';
$this->params['breadcrumbs'][] = 'Informe inventario';
?>

        <br>


<div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="no-margin">
            Informe Inventario
        </h3>
    </div>
    <div class="box-body">
        <div class="box box-primary">
            <div class="box-body">
                <div class="col-md-6 col-md-offset-3">
                    <div class="margin-bottom">
                        <label class="control-label">
                            Tipo de Informe
                        </label>
                        <?php 
                            echo Select2::widget([
                                'name' => 'tipo',
                                'value' => '',
                                'data' => [1 => "Flujos", 2 => "Almacenados"],
                                'options' => ['placeholder' => 'Seleccionar tipo de informe', 'id'=>'tipo'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]);
                        ?>
                    </div>
                    <div class="margin-bottom">
                        <label class="control-label">
                            Recurso
                        </label>
                        <?php 
                            echo Select2::widget([
                                'name' => 'recurso',
                                'value' => '',
                                'data' => [1 => "Materiales", 2 => "Herramientas"],
                                'options' => ['placeholder' => 'Seleccionar recurso', 'id'=>'recurso_id'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]);
                        ?>
                    </div>
                        <?php /*
                    <div class="margin-bottom">
                        <label class="control-label">
                            Orden de Trabajo
                        </label>
                            echo Select2::widget([
                                'name' => 'orden',
                                'value' => '',
                                'data' => ArrayHelper::map(OrdenTrabajo::find()->where(['PRO_ID'=>$proyecto->PRO_ID])->all(),'OT_ID','OT_NOMBRE','OT_ESTADO'),
                                'options' => ['placeholder' => 'Seleccionar orden de trabajo', 'id'=>'orden'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]);
                    </div>*/
                        ?>
                    <div class="margin-bottom">
                        <label class="control-label">
                            Fecha
                        </label>
                        <?= DateRangePicker::widget([
                            'name' => 'date_from',
                            //'value' => $proyecto->PRO_FECHA_INICIO,
                            'nameTo' => 'name_to',
                            'valueTo' => date('Y-m-d'),
                            'language' => 'es',
                            'clientOptions' => [
                                'autoclose' => true,
                                'format' => 'yyyy-mm-dd',
                                'todayHighlight' => true,
                                //'startDate' => $proyecto->PRO_FECHA_INICIO,
                                'endDate' => date('Y-m-d')
                            ]
                        ]);?>
                    </div>
                    <?= Html::submitButton('Generar Informe', ['class' => 'btn btn-primary btn-flat btn-block margin-bottom']) ?>

                </div>
            </div>
        </div>
    </div>
</div>



