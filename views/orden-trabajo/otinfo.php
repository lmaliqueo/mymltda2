<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;

?>
                <?php if ($model!=NULL) { ?>
                        <dic class="nav-tabs-custom">
                            <ul class="nav nav-tabs pull-right">
                                <li class="active"><a href="" data-toggle="tab" aria-expanded="true">Actividades</a></li>
                                <li><a href="" data-toggle="tab" aria-expanded="false">Calendario</a></li>
                                <li><a href="" data-toggle="tab" aria-expanded="false">Reportes de Avances</a></li>
                                <li><a href="" data-toggle="tab" aria-expanded="false">Stock de Materiales</a></li>
                                <li class="pull-left header"><strong>OT:</strong> <?= $model->OT_NOMBRE ?></li>
                            </ul>
                            <div class="callout callout-info"><h4>hola</h4></div>
                        </dic>
                <?php }else{ ?>
                        <div class="bs-callout bs-callout-primary"><h4>hola</h4></div>
               <?php } ?>
