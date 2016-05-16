<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AsignaTieneSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Asigna Tienes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asigna-tiene-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Asigna Tiene', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'AT_ID',
            'AS_ID',
            'EP_ID',
            'AT_CANTIDAD',
            'AT_COSTO_EP',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
