<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use app\models\Actividades;
use app\models\StockMateriales;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrdenTrabajoTrabajo */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<div class="orden-trabajo-index">


        <h1>Orden de Trabajo</h1>
<br>
    <?= $this->render('indexact', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'ordentrabajo' => $ordentrabajo,
    ]) ?>




</div>