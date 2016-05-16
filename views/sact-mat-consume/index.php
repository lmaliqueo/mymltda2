<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SactMatConsumeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sact Mat Consumes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sact-mat-consume-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Sact Mat Consume', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'CONS_ID',
            'MA_ID',
            'SACT_ID',
            'CONS_CANTMATERIAL',
            'CONS_COSTO',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
