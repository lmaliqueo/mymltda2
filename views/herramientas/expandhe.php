<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Herramientas */
?>
<br>
<div class="herramientas-view">


    <div class="col-md-6">
    <div class="panel panel-primary">
      <!-- Default panel contents -->
      <div class="panel-heading"><span class="glyphicon glyphicon glyphicon-wrench" aria-hidden="true"></span> <strong>Herramienta: </strong><?= Html::encode($model->HE_NOMBRE) ?></div>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'HE_ID',
                'BO_ID',
                'HE_CANT',
                'HE_COSTOUNIDAD',
            ],
        ]) ?>

    </div>
    </div>
    <div class="col-md-1">
        <table class="table table-hover">
            <?php foreach ($hetiene as $row) { ?>

                <tr>
                    <?php if($row->EH_ID==1){ ?>
                        <td><strong><span class="text-success"><?= $row->eH->EH_NOMBREESTADO ?></span></strong></td>
                    <?php }elseif ($row->EH_ID==2) { ?>
                        <td><strong><span class="text-primary"><?= $row->eH->EH_NOMBREESTADO ?></span></strong></td>
                    <?php }elseif ($row->EH_ID==3) { ?>
                        <td><strong><span class="text-info"><?= $row->eH->EH_NOMBREESTADO ?></span></strong></td>
                    <?php }elseif ($row->EH_ID==4) { ?>
                        <td><strong><span class="text-danger"><?= $row->eH->EH_NOMBREESTADO ?></span></strong></td>
                    <?php }elseif ($row->EH_ID==5) { ?>
                        <td><strong><span class="text-warning"><?= $row->eH->EH_NOMBREESTADO ?></span></strong></td>
                    <?php } ?> 
                    <?php if($row->EH_ID==1){ ?>
                        <td class="text-right"><span class="label label-success btn"><?= $row->HT_CANTHEESTADO ?></span></td>
                    <?php }elseif ($row->EH_ID==2) { ?>
                        <td class="text-right"><span class="label label-primary btn"><?= $row->HT_CANTHEESTADO ?></span></td>
                    <?php }elseif ($row->EH_ID==3) { ?>
                        <td class="text-right"><span class="label label-warning btn"><?= $row->HT_CANTHEESTADO ?></span></td>
                    <?php }elseif ($row->EH_ID==4) { ?>
                        <td class="text-right"><span class="label label-danger btn"><?= $row->HT_CANTHEESTADO ?></span></td>
                    <?php }elseif ($row->EH_ID==5) { ?>
                        <td class="text-right"><span class="label label-info btn"><?= $row->HT_CANTHEESTADO ?></span></td>
                    <?php } ?> 
                </tr>

            <?php } ?>

        </table>
    </div>









</div>
