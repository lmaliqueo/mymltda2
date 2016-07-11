<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use app\models\BoMatAlmacena;
use app\models\StockMateriales;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MaterialesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Materiales';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php 
    Modal::begin([
            'header'=>'<h4>Orden de Despacho</h4>',
            'id'=>'modal-view-od',
            'size'=>'modal-lg',
        ]);
    echo "<div class='modalContentOD'></div>";
    Modal::end();
 ?>

<table class="table table-hover table-bordered">
    <tr class="bg-gray">
        <th>N°</th>
        <th>Orden de Trabajo</th>
        <th>Fecha Pedido</th>
        <th>Fecha Recepción</th>
        <th>Estado</th>
        <th>Costo Total</th>
        <th></th>
    </tr>
    <?php foreach ($ordenes_despacho as $count => $despacho) { ?>
        <tr>
            <td><?= $despacho->OD_NUMERO_ORDEN ?></td>
            <td><?= $despacho->oT->OT_NOMBRE ?></td>
            <td class="text-center"><?= $despacho->OD_FECHA_EMISION ?></td>
            <td class="text-center"><?php if ($despacho->OD_FECHA_RECEPCION!=NULL) {
                echo $despacho->OD_FECHA_RECEPCION;
            }else{
                echo '-';
            } ?></td>
            <td><?= $despacho->OD_ESTADO ?></td>
            <td>$ </td>
            <td><?php
            if ($despacho->OD_ESTADO=='Pendiente') {
                echo Html::a('Aprovar despacho',['autorizar-orden-despacho', 'id'=>$despacho->OD_ID],['class'=>'btn btn-flat btn-success']);
            } ?>
            <?= Html::button('Ver despacho', ['value'=>Url::to(['ver-orden-despacho','id'=>$despacho->OD_ID]), 'class'=>'btn btn-flat btn-warning btn-sm modalDespacho']) ?>

        </tr>
    <?php } ?>
</table>


<?php 
$script = <<< JS
    $(function() {

       $('.modalDespacho').click(function() {
         $('#modal-view-od').modal('show')
         .find('.modalContentOD')
         .load($(this).attr('value'));
       });

    });

JS;
$this->registerJs($script);
?>
