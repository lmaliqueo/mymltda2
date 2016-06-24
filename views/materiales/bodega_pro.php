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
    <tr class="bg-light-black">
        <th>ID</th>
        <th>Material</th>
        <th>Tipo Material</th>
        <?php /*<th>OT</th>*/ ?>
        <th>Bodega</th>
        <th>Cantidad</th>
    </tr>
    <?php foreach ($materiales as $material) { ?>
        <tr>
            <td><?= $material->MA_ID ?></td>
            <td><?= $material->bO->BO_NOMBRE ?></td>
            <td><?= $material->mA->MA_NOMBRE ?></td>
            <td><?= $material->mA->tMA->TMA_NOMBRE ?></td>
            <td><?= $material->ALM_CANTMATERIALES ?></td>
        </tr>
    <?php } ?>
</table>