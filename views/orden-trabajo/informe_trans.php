<?php 
use yii\helpers\Html;
 ?>


<h1>hola</h1>


<div class="row">
    <div class="col-md-6">
        <table class="table table-hover">
            <tr>
                <th>Nombre</th>
                <th>Cantidad</th>
            </tr>
            <?php foreach ($stock as $mat) { ?>
                <tr>
                    <td><?= $mat->mA->MA_NOMBRE ?></td>
                    <td><?= $mat->SM_CANTIDAD ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <div class="col-md-6">
    </div>
</div>




<?php /*

<div class="box box-warning">
    <div class="box-header with-border"><h4 class="box-title"><strong>Material:</strong> <?= Html::encode($stock->mA->MA_NOMBRE) ?> </h4><div class="box-tools" style="width: 10%"><strong>Total:</strong> <span class="badge bg-blue"><?= $stock->SM_CANTIDAD ?></span></div></div>
    <div class="box-body">

<div class="row">
<div class="col-md-7">
        <h4 class="title"><i class="glyphicon glyphicon-log-in text-green"> Ingresados</i> </h4>
        <table class="table table-hover">
            <tbody>
            <tr class="bg-green disabled">

                <th>Fecha</th>
                <th>Cantidad</th>
                <th>Costo</th>
            </tr>
            <?php 
            $total=0;
            $costo=0;
             ?>
            <?php foreach ($adquirido as $key): ?>
            <tr>
                <td><?= $key->tM->TM_FECHACOMPRA ?></td>
                <td><span class="badge bg-green"><?= $key->tM->TM_CANTIDAD ?></span></td>
                <td><?= $key->tM->TM_PRECIO ?></td>
                <?php 
                $total= $total + $key->tM->TM_CANTIDAD;
                $costo= $costo + $key->tM->TM_PRECIO; ?>

            </tr>
            <tr>
                <td class="text-right success">Total:</td>
                <td class="success"><strong><?= $total ?></strong></td>
                <td class="success"><strong><?= $costo ?></strong></td>
            </tr>
            <?php endforeach ?>

            </tbody>

        </table>

</div>
<div class="col-md-5">

        <h4 class="title"><i class="glyphicon glyphicon-log-out text-red"> Utilizados</i> </h4>
        <table class="table table-hover">




            <tbody>
            <tr class="bg-red">

                <th>Fecha</th>
                <th>Cantidad</th>
            </tr>
            <?php 
            $usado=0;
             ?>
            <?php foreach ($utilizados as $usados): ?>
            <tr>
                <td><?= $usados->CU_FECHA_FINAL ?></td>
                <td><span class="badge bg-red"><?= $usados->CU_CANTIDAD ?></span></td>
                <?php 
                $usado= $usado + $usados->CU_CANTIDAD;
                ?>
            </tr>
            <tr>
                <td class="text-right danger">Total:</td>
                <td class="danger"><strong><?= $usado ?></strong></td>
            </tr>
            <?php endforeach ?>

            </tbody>

        </table>


</div>
</div>



    </div>
</div>



    <div class="panel panel-info">
      <!-- Default panel contents -->
      <div class="panel-heading"><h4 class="text-center"><strong>Movimientos: <?= Html::encode($material->MA_NOMBRE) ?></strong></h4></div>

        <table class="table table-hover table-bordered">




            <tbody>
            <tr class="active">

                <th>Proveedor</th>
                <th>Fecha</th>
                <th>Cantidad</th>
                <th>Costo</th>
            </tr>
            <?php foreach ($adquirido as $key): ?>
            <tr>
                <td><?= $key->pROV->PROV_NOMBRE ?></td>
                <td><?= $key->tM->TM_FECHACOMPRA ?></td>
                <td><span class="badge bg-green"><?= $key->tM->TM_CANTIDAD ?></span></td>
                <td><?= $key->tM->TM_PRECIO ?></td>

            </tr>
            <?php endforeach ?>

            </tbody>

        </table>


    </div>
*/ ?>