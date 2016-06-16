<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\Proyecto */

$this->title = $model->PRO_NOMBRE;
$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proyecto-view">

    <h1>Detalles</h1>


<?php 
    Modal::begin([
            'header'=>'<h4>Asignar Encargado de Construcción</h4>',
            'id'=>'modal',
            'size'=>'modal-tn',
        ]);
    echo "<div class='modalContent'></div>";
    Modal::end();
 ?>

<br>
<div class="row">
    <div class="col-md-3">
            <?= Html::button('Asignar Encargado', ['value'=>Url::to(['proyecto/asignar-encargado','id' => $model->PRO_ID]), 'class' => 'btn btn-primary btn-block margin-bottom','id'=>'modalButton']) ?>
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Proyecto</h3>
            </div>
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href="#"><i class="fa fa-eye"></i> Detalles</a></li>
                    <?php /*<li class="view" id="<?php echo $model->PRO_ID; ?>"><a href="#"><i class="fa fa-tasks"></i> <span style="padding-left:5px">InformaciÃ³n</span></a></li>*/ ?>
                    <li><?= Html::a('<i class="fa fa-tasks"></i> Ordenes de Trabajos', ['orden-trabajo/indexpro', 'id'=>$model->PRO_ID]) ?></li>
                    <li><?= Html::a('<i class="fa fa-file-excel-o"></i> Estados de Pagos', ['estado-pago/index', 'id'=>$model->PRO_ID]) ?></li>
                    <li><?= Html::a('<i class="glyphicon glyphicon-usd"></i> Gastos Generales', ['gastos-generales/index', 'id'=>$model->PRO_ID]) ?></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-9">

<div class="box box-primary">
    <div class="box-header"><h3 class="box-title"><?= $model->PRO_NOMBRE ?></h3></div>
    <div class="box-body">
        <div id="contenido">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'PRO_ID',
                    'cOM.COM_NOMBRE',
                    'eMPRUT.EMP_NOMBRE',
                    'PRO_COSTO_TOTAL',
                    'PRO_FECHA_INICIO',
                    'PRO_FECHA_FINAL',
                    'PRO_ESTADO',
                    'PRO_DIRECCION',
                ],
            ]) ?>
        </div>
    </div>
    <div class="box-footer">
        <?= Html::a('Eliminar', ['delete', 'id' => $model->PRO_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </div>
</div>
</div>
</div>
</div>

<?php 
$script = <<< JS

$(function(){
    $(document).on('click', '.view', function(e) {
        $(this).addClass('active');
    });

});



    
JS;
$this->registerJs($script);
?>

