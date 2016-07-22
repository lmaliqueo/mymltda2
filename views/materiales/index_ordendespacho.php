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



<h1>Despacho Materiales</h1>
<br>
<div class="row">
    <div class="col-md-3">
        <?= Html::a('Ingresar Orden de Despacho', 'index.php?r=materiales/ingresar-orden-compra',['class'=> 'btn btn-success btn-flat btn-block margin-bottom']) ?>
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Operaciones</h3>
            </div>
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <li><?= Html::a('Lista materiales', ['materiales/index']) ?></li>
                    <li><?= Html::a('Adquisición materiales', ['materiales/orden-compra-index']) ?></li>
                    <li class="active"><a href="#">Despacho materiales</a></li>
                    <li><?= Html::a('Pedidos materiales', ['pedido-materiales/index']) ?></li>
                    <li><?= Html::a('Proveedores', ['proveedor/index']) ?></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-9">    
        <div class="box box-primary">
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
                                echo Html::button('Ver despacho', ['value'=>Url::to(['ver-orden-despacho','id'=>$despacho->OD_ID]), 'class'=>'btn btn-flat btn-warning btn-sm modalDespacho']);
                            }elseif($despacho->OD_ESTADO=='Denegado'){
                                echo Html::button('Ver despacho', ['value'=>Url::to(['ver-orden-despacho','id'=>$despacho->OD_ID]), 'class'=>'btn btn-flat btn-danger btn-sm modalDespacho']);
                            }else{
                                echo Html::button('Ver despacho', ['value'=>Url::to(['ver-orden-despacho','id'=>$despacho->OD_ID]), 'class'=>'btn btn-flat btn-primary btn-sm modalDespacho']);
                            } ?>
                        </td>
                    </tr>
                <?php } ?>
            </table>

        </div>
    </div>
</div>






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
