<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BodegasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bodegas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bodegas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Bodegas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'BO_ID',
            'BO_NOMBRE',
            'BO_DIRECCION',
            'BO_CANTIDADHERRAMIENTAS',
            'BO_CANTIDADMATERIALES',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
