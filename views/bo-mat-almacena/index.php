<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BoMatAlmacenaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bo Mat Almacenas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bo-mat-almacena-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Bo Mat Almacena', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'AL_ID',
            'BO_ID',
            'MA_ID',
            'AL_CANTMATERIALES',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
