<br>
<?php 
use yii\helpers\Html;
 ?>


	<div class="col-md-7">
    <div class="panel panel-success">
      <!-- Default panel contents -->
      <div class="panel-heading"><span class="glyphicon glyphicon glyphicon-list-alt" aria-hidden="true"></span> <strong>Actividades</strong></div>

        <table class="table table-hover table-bordered table-condensed">




            <tbody>
            <tr class="active">

                <th>ACtividad</th>
                <th>Fecha de Inicio</th>
                <th>Fecha Termino</th>
                <th>Estado</th>
            </tr>
            <?php foreach ($actividades as $key): ?>
            <tr>
                <td><?= $key->AC_NOMBRE ?></td>
                <td><?= $key->AC_FECHA_INICIO ?></td>
                <td><?= $key->AC_FECHA_TERMINO ?></td>
                <td><span class="badge bg-blue"><?= $key->AC_ESTADO ?></span></td>

            </tr>
            <?php endforeach ?>

            </tbody>

        </table>

    <div class="panel-footer clearfix">
        <div class="pull-centered">

        <?= Html::a('<span class="glyphicon glyphicon glyphicon-calendar" aria-hidden="true"></span> Ver Calendario', ['actividades/calendario', 'id' => $model->OT_ID], ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    </div>


	</div>
	<div class="col-md-5">

    <div class="panel panel-primary">
      <!-- Default panel contents -->
      <div class="panel-heading"><span class="glyphicon glyphicon glyphicon-transfer" aria-hidden="true"></span> <strong>Stock de Materiales</strong></div>

        <table class="table table-hover table-bordered table-condensed">




            <tbody>
            <tr class="active">

                <th>Proveedor</th>
                <th class="text-right">Cantidad</th>
            </tr>
            <?php foreach ($stock as $key): ?>
            <tr>
                <td><?= $key->mA->MA_NOMBRE ?></td>
                <td class="text-right"><span class="badge bg-green"><?= $key->SM_CANTIDAD ?></span></td>

            </tr>
            <?php endforeach ?>

            </tbody>

        </table>

    <div class="panel-footer clearfix">
        <div class="pull-centered">

            <?= Html::a('<span class="glyphicon glyphicon glyphicon-transfer" aria-hidden="true"></span> Ver Movimientos', ['transaccion', 'id' => $model->OT_ID], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    </div>

	</div>



