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
$this->title = $proyecto->PRO_NOMBRE;
$this->params['breadcrumbs'][] = ['label' => $proyecto->PRO_NOMBRE, 'url' => ['proyecto/view', 'id'=>$proyecto->PRO_ID]];
$this->params['breadcrumbs'][] = 'Informes';
?>

        <h1>Informes</h1>
        <br>

<div class="row">
    <div class="col-md-3">

                    <?= Html::a('Generar Informe',['informe-ot', 'idot'=>$proyecto->PRO_ID],['class'=>'btn btn-flat btn-primary btn-block margin-bottom']) ?>

        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Proyecto</h3>
            </div>
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <li><?= Html::a('<i class="fa fa-eye"></i> Detalles', ['proyecto/view', 'id'=>$proyecto->PRO_ID]) ?></li>
                    <?php /*<li class="view" id="<?php echo $model->PRO_ID; ?>"><a href="#"><i class="fa fa-tasks"></i> <span style="padding-left:5px">InformaciÃ³n</span></a></li>*/ ?>
                    <li><?= Html::a('<i class="fa fa-tasks"></i> Ordenes de Trabajos', ['orden-trabajo/indexpro', 'id'=>$proyecto->PRO_ID]) ?></li>
                    <li><?= Html::a('<i class="fa fa-file-excel-o"></i> Estados de Pagos', ['estado-pago/index', 'id'=>$proyecto->PRO_ID]) ?></li>
                    <li><?= Html::a('<i class="fa fa-inbox"></i> Reportes de Avances', ['reportes-avances/index', 'id'=>$proyecto->PRO_ID]) ?></li>
                    <li><?= Html::a('<i class="glyphicon glyphicon-usd"></i> Gastos Generales', ['gastos-generales/index', 'id'=>$proyecto->PRO_ID]) ?></li>
                    <li><?= Html::a('<i class="glyphicon glyphicon-list-alt"></i> Materiales', ['materiales/materiales-pro', 'id'=>$proyecto->PRO_ID]) ?></li>
                    <li class="active"><a href="#"><i class="glyphicon glyphicon-file"></i> Informes</a></li>
                </ul>
            </div>
        </div>

    </div>
    <div class="col-md-9">
        <div class="box">
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
                                'data' => [1 => "Materiales", 2 => "Orden de Trabajo", 3 => "Proyecto"],
                                'options' => ['placeholder' => 'Seleccionar tipo de informe', 'id'=>'tipo'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]);
                        ?>
                    </div>
                    <div class="margin-bottom">
                        <label class="control-label">
                            Orden de Trabajo
                        </label>
                        <?php 
                            echo Select2::widget([
                                'name' => 'orden',
                                'value' => '',
                                'data' => ArrayHelper::map(OrdenTrabajo::find()->where(['PRO_ID'=>$proyecto->PRO_ID])->all(),'OT_ID','OT_NOMBRE','OT_ESTADO'),
                                'options' => ['placeholder' => 'Seleccionar orden de trabajo', 'id'=>'orden'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]);
                        ?>
                    </div>
                    <div class="margin-bottom">
                        <label class="control-label">
                            Fecha
                        </label>
                        <?= DateRangePicker::widget([
                            'name' => 'date_from',
                            'value' => $proyecto->PRO_FECHA_INICIO,
                            'nameTo' => 'name_to',
                            'valueTo' => date('Y-m-d'),
                            'language' => 'es',
                            'clientOptions' => [
                                'autoclose' => true,
                                'format' => 'yyyy-mm-dd',
                                'todayHighlight' => true,
                                'startDate' => $proyecto->PRO_FECHA_INICIO,
                                'endDate' => date('Y-m-d')
                            ]
                        ]);?>
                    </div>
                </div>
                <div class="col-md-6">

                </div>




            </div>
        </div>
    </div>
</div>



