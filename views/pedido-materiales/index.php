<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PedidoMaterialesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pedido Materiales';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-materiales-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pedido Materiales', ['create-multi'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'PM_ID',
            'PRO_ID',
            'PM_ESTADO',
            'PM_TITULO',
            'PM_FECHA',
            // 'PM_TEXTO:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
