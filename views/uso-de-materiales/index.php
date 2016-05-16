<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsoDeMaterialesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Uso De Materiales';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uso-de-materiales-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Uso De Materiales', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'UM_ID',
            'AC_ID',
            'UM_CANTIDADTOTA',
            'UM_COSTOTOTAL',
            'UM_FECHA',
            // 'UM_ESTADO',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
