 <?php 
use yii\helpers\Html;
 ?>
                                <div class="panel panel-primary">
                                   <div class="panel-heading"><h4 class="text-center"><strong>Subactividades Asignados</strong></h4></div>


                                            <table class="table table-bordered">
                                        <tr>
                                            <th>Cantidad</th>
                                            <th>Subactividad</th>
                                            <th>Costo por Subactividad</th>
                                       </tr>
                                        <?php foreach ($asignados as $key): ?>
                                        <tr>
                                                        <td><?= $key->AS_CANTIDAD ?></td>
                                                        <td><?= $key->sACT->SACT_NOMBRE ?></td>
                                                        <td><?= $key->AS_COSTOTOTAL ?></td>
                                        </tr>
                                        <?php endforeach ?>


                                       </table>




                                    </div>
