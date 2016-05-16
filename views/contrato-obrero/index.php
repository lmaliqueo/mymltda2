<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContratoObreroSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contrato Obreros';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contrato-obrero-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Contrato Obrero', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'COO_ID',
            'PE_RUT',
            'PRO_ID',
            'TOB_ID',
            'COO_FECHA',
            'COO_ESTADO',
            // 'COO_HORAS',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
