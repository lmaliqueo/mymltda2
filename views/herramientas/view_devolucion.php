<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Herramientas */

$this->title = $model->HE_ID;
$this->params['breadcrumbs'][] = ['label' => 'Herramientas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="herramientas-view">




    <div class="box">
        <div class="box-header">
            <h4 class="box-title"><?= $model->HE_NOMBRE ?></h4>
        </div>
        <div class="box-body no-padding">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <td><?= $model->HE_ID ?></td>
                    <th>Cantidad</th>
                    <td><?= $model->HE_CANT ?></td>
                </tr>
                <tr>
                    <th>Almacenado</th>
                    <td><?= $model->bO->BO_NOMBRE ?></td>
                    <th>Costo Asociado</th>
                    <td>$ <?= $model->HE_COSTOUNIDAD ?></td>
                </tr>
            </table>
            <table class="table table-bordered">
                <tr>
                    <th colspan="<?php echo (2*$cant_estado); ?>" class="bg-gray">Cantidad</th>
                </tr>
                <tr>
                    <?php foreach ($estado_he as $estado) { ?>
                        <th><?= $estado->eH->EH_NOMBREESTADO ?>:</th>
                        <td class="active"><?= $estado->HT_CANTHEESTADO ?></td>
                    <?php } ?>
                </tr>
            </table>
        </div>
    </div>

    <p>
        <?= Html::a('Borrar', ['delete', 'id' => $model->HE_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>


