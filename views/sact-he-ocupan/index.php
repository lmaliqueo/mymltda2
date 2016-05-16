<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SactHeOcupanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sact He Ocupans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sact-he-ocupan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Sact He Ocupan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'OC_ID',
            'HE_ID',
            'SACT_ID',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
