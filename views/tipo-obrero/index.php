<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TipoObreroSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tipo Obreros';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-obrero-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tipo Obrero', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'TOB_ID',
            'TOB_NOMBRE',
            'TOB_DESCRIPCION',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
