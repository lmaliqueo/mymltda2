<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SueldoObreroSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sueldo Obreros';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sueldo-obrero-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Sueldo Obrero', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'SU_ID',
            'COO_ID',
            'SU_CANTIDAD',
            'SU_FECHA',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
