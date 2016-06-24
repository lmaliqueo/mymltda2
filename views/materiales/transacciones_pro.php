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
            'header'=>'<h4>Material</h4>',
            'id'=>'modal-view',
            'size'=>'modal-lg',
        ]);
    echo "<div class='modalContent'></div>";
    Modal::end();
 ?>

<table class="table table-hover">
    <tr class="bg-blue">
        <th>Orden de Trabajo</th>
        <th>Material</th>
        <th>Cantidad</th>
        <th>Costo</th>
        <?php /*<th>Enviado</th>*/ ?>
        <th>Fecha</th>
        <th>Proveedor</th>
    </tr>
    <?php foreach ($transacciones as $transaccion) { ?>
        <tr>
            <td><?= $transaccion->tM->sM->oT->OT_NOMBRE ?></td>
            <td><?= $transaccion->mA->MA_NOMBRE ?></td>
            <td><?= $transaccion->tM->TM_CANTIDAD ?></td>
            <td><?= $transaccion->tM->TM_COSTO ?></td>
            <?php /*<td><?= $transaccion->tM ?></td>*/ ?>
            <td><?= $transaccion->tM->TM_FECHACOMPRA ?></td>
            <td><?= $transaccion->pROV->PROV_NOMBRE ?></td>
        </tr>
    <?php } ?>
</table>