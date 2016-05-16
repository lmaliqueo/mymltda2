<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StockMaterialesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Stock Materiales';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-materiales-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Stock Materiales', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'SM_ID',
            'OT_ID',
            'MA_ID',
            'SM_CANTIDAD',
            'SM_ESTADO',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
