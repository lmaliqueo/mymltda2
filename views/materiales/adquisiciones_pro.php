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

<table class="table table-hover table-bordered">
    <tr class="warning">
        <th>O. Trabajo</th>
        <th>Material</th>
        <th>Cantidad</th>
        <th>Costo</th>
        <th>Bodega</th>
        <th>Fecha</th>
        <th>O.C.</th>
        <th>Estado</th>
        <th>Proveedor</th>
    </tr>
    <?php foreach ($adquisicion as $adq) { ?>
        <tr>
            <td><?= $adq->sM->oT->OT_NOMBRE ?></td>
            <td><?= $adq->mA->MA_NOMBRE ?></td>
            <td><?= $adq->AD_CANTIDAD ?></td>
            <td><?= $adq->AD_COSTO_TOTAL ?></td>
            <td><?php if ($adq->BO_ID!=NULL) {
                echo $adq->bO->BO_NOMBRE;
            } ?></td>
            <td><?= $adq->AD_FECHA ?></td>
            <td><?= $adq->oRC->ORC_NUMERO_ORDEN ?></td>
            <td><?= $adq->oRC->ORC_ESTADO ?></td>
            <td><?= $adq->oRC->pROV->PROV_NOMBRE ?></td>
        </tr>
    <?php } ?>
</table>