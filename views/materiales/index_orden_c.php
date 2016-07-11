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
            'header'=>'<h4>Orden de Compra</h4>',
            'id'=>'modal-view-oc',
            'size'=>'modal-lg',
        ]);
    echo "<div class='modalContentOC'></div>";
    Modal::end();
 ?>

<table class="table table-hover table-bordered">
    <tr class="success">
        <th>N°</th>
        <th>Orden de Trabajo</th>
        <th>Proveedor</th>
        <th>Fecha Pedido</th>
        <th>Fecha Pago</th>
        <th>Destino</th>
        <th>Estado</th>
        <th>Costo Total</th>
        <th></th>
    </tr>
    <?php foreach ($ordenes_compra as $count => $compra) { ?>
        <tr>
            <td><?= $compra->ORC_NUMERO_ORDEN ?></td>
            <td><?= $compra->oT->OT_NOMBRE ?></td>
            <td><?= $compra->pROV->PROV_NOMBRE ?></td>
            <td class="text-center"><?= $compra->ORC_FECHA_PEDIDO ?></td>
            <td class="text-center"><?php if ($compra->ORC_FECHA_PAGO!=NULL) {
                echo $compra->ORC_FECHA_PAGO;
            }else{
                echo '-';
            } ?></td>
            <td><?= $envio[$count] ?></td>
            <td><?= $compra->ORC_ESTADO ?></td>
            <td>$ <?= $compra->ORC_COSTO_TOTAL ?></td>
            <td><?php
            if ($compra->ORC_ESTADO=='Pendiente') {
                echo Html::a('Aprovar compra',['autorizar-orden-compra', 'id'=>$compra->ORC_ID],['class'=>'btn btn-flat btn-success']);
            }
             ?>            
                <?= Html::button('Ver compra', ['value'=>Url::to(['ver-orden-compra','id'=>$compra->ORC_ID]), 'class'=>'btn btn-flat btn-warning btn-sm modalCompra']) ?>
            </td>

        </tr>
    <?php } ?>
</table>



<?php 
$script = <<< JS
    $(function() {

       $('.modalCompra').click(function() {
         $('#modal-view-oc').modal('show')
         .find('.modalContentOC')
         .load($(this).attr('value'));
       });

    });

JS;
$this->registerJs($script);
?>
