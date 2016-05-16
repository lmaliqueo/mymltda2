<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PedidoAdjuntaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pedido Adjuntas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-adjunta-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pedido Adjunta', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'PV_ID',
            'PM_ID',
            'SM_ID',
            'VI_CANTIDADMAT',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
