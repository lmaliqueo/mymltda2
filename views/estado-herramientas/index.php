<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EstadoHerramientasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Estado Herramientas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estado-herramientas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Estado Herramientas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'EH_ID',
            'EH_NOMBREESTADO',
            'EH_DESCRIPCION',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
