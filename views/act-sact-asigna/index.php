<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ActSactAsignaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Act Sact Asignas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="act-sact-asigna-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Act Sact Asigna', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'AS_ID',
            'AC_ID',
            'SACT_ID',
            'AS_CANTIDAD',
            'AS_COSTOTOTAL',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
