<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ManodeobraTrabajanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manodeobra Trabajans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manodeobra-trabajan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Manodeobra Trabajan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'TRAB_ID',
            'PE_RUT',
            'AC_ID',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
