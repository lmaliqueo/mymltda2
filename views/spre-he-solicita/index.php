<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SpreHeSolicitaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Spre He Solicitas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="spre-he-solicita-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Spre He Solicita', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'SOLI_ID',
            'SPRE_ID',
            'HE_ID',
            'SOLI_CANTIDAD',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
