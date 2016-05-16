<?php 
use yii\helpers\Html;
 ?>

    <div class="box box-warning">
        <div class="box-header with-border"><h4 class="box-title"><?= $subact->SACT_NOMBRE ?></h4>
            <div class="box-tools"><h3 class="text-orange no-margin">$ <?= $subact->SACT_COSTO ?></h3></div>
        </div>
        <div class="box-body">


            <div class="row">
                <div class="col-md-4">
                    <table class="table">
                        <tr class="bg-orange">
                            <th>N°</th>
                                <th>Materiales</th>
                        </tr>
                        <tbody class="table table-bordered">
                            <?php foreach ($materiales as $mat){ ?>
                                <tr>
                                    <td><?= $mat->CONS_CANTIDAD ?></td>
                                    <td><?= $mat->tMA->TMA_NOMBRE ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-4">
                    <table class="table">
                        <tr class="bg-orange">
                            <th>N°</th>
                            <th>Herramientas</th>
                        </tr>
                        <tbody class="table table-bordered">
                            <?php foreach ($herramientas as $he){ ?>
                                <tr>
                                    <td><?= $he->OC_CANTIDAD ?></td>
                                    <td><?= $he->tH->TH_NOMBRE ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-4">
                    <table class="table">
                        <tr class="bg-orange">
                                <th>N°</th>
                                <th>Obreros</th>
                        </tr>
                        <tbody class="table table-bordered">
                            <?php foreach ($obreros as $ob){ ?>
                                <tr>
                                    <td><?= $ob->RE_CANTIDAD ?></td>
                                    <td><?= $ob->tOB->TOB_NOMBRE ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php /*
                            <div class="col-sm-6">



                                <div class="panel panel-success">
                                   <div class="panel-heading"><strong><span class="glyphicon glyphicon glyphicon-list-alt" aria-hidden="true"></span> Subactividad:</strong> <?= Html::encode($subact->SACT_NOMBRE) ?></div>


                                            <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Cantidad</th>
                                                <th>Material</th>
                                                <th>Costo</th>
                                           </tr>
                                        </thead>
                                       <tbody>
                                            <?php foreach ($consume as $key): ?>
                                            <tr>
                                                            <td><?= $key->CONS_CANTMATERIAL ?></td>
                                                            <td><?= $key->mA->MA_NOMBRE ?></td>
                                                            <td><?= $key->CONS_COSTO ?></td>
                                            </tr>
                                            <?php endforeach ?>
                                        </tbody>

                                       </table>




                                    </div>

                            </div>*/ ?>