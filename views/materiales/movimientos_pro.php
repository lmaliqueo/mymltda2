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
<?php $contador_ut=0; ?>
<table class="table table-hover">
    <tr class="bg-light-blue">
        <th>Orden de Trabajo</th>
        <th>Material</th>
        <th>Cantidad</th>
        <?php /*<th>Enviado</th>*/ ?>
        <th>Fecha</th>
        <th></th>
    </tr>
    <?php foreach ($transacciones as $transaccion) { 
        foreach ($utlizados as $utilizado) {
            if ($transaccion->TM_FECHACOMPRA < $utilizado[$contador_ut]->CU_FECHA_FINAL) { ?>
                <tr>
                    <td><?= $transaccion->tM->sM->oT->OT_NOMBRE ?></td>
                    <td><?= $transaccion->mA->MA_NOMBRE ?></td>
                    <td><?= $transaccion->tM->TM_CANTIDAD ?></td>
                    <td><?= $transaccion->tM->TM_FECHACOMPRA ?></td>
                    <?php break; ?>
                </tr>
        <?php }else{ ?>
                <tr>
                    <td><?= $utilizado[$contador_ut]->sM->oT->OT_NOMBRE ?></td>
                    <td><?= $utilizado[$contador_ut] ?></td>
                    <td><?= $utilizado[$contador_ut] ?></td>
                </tr>
            <?php $contador_ut=$contador_ut+1;
            }
        } 
    } ?>
</table>