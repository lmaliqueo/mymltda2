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
    <tr class="bg-navy">
        <th>Orden de Trabajo</th>
        <th>Material</th>
        <th>Cantidad</th>
        <th>Fecha</th>
        <th></th>
    </tr>
    <?php foreach ($pedidos as $pedido) { ?>
        <tr>
            <td><?= $pedido->sM->oT->OT_NOMBRE ?></td>
            <td><?= $pedido->sM->mA->MA_NOMBRE ?></td>
            <td><?= $pedido->PA_CANTIDADMAT ?></td>
            <td><?= $pedido->pM->PM_FECHA ?></td>
        </tr>
    <?php } ?>
</table>