<?php 
use yii\helpers\Html;
 ?>

    <div class="panel panel-danger">
      <!-- Default panel contents -->
      <div class="panel-heading"><h4 class="text-center"><strong>Historial Pedidos: <?= Html::encode($material->MA_NOMBRE) ?></strong></h4></div>

        <table class="table table-hover table-bordered">




            <tbody>
            <tr class="active">

                <th>Pedido Materiales</th>
                <th>Cantidad</th>
                <th>Estado</th>
                <th>Fecha</th>
            </tr>
            <tr>
            <?php foreach ($pedidos as $key): ?>
                <td><?= $key->pM->PM_TITULO ?></td>
                <td><?= $key->PA_CANTIDADMAT ?></td>
                <td>
                    <?php if($key->pM->PM_ESTADO=='Pendiente'){ ?>
                        <span class="badge bg-yellow"><?= $key->pM->PM_ESTADO ?></span>
                    <?php }elseif($key->pM->PM_ESTADO=='Finalizado'){ ?>
                        <span class="badge bg-green"><?= $key->pM->PM_ESTADO ?></span>
                        <?php }elseif ($key->pM->PM_ESTADO=='Incompleto') { ?>
                            <span class="badge bg-blue"><?= $key->pM->PM_ESTADO ?></span>
                        <?php } ?>
                </td>
                <td><?= $key->pM->PM_FECHA ?></td>
            <?php endforeach ?>

            </tr>

            </tbody>

        </table>


    </div>
