<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TransaccionMaterialesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transaccion Materiales';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaccion-materiales-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Transaccion Materiales', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
    'summary'=>'',
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'TM_ID',
            'SM_ID',
            'TM_FECHACOMPRA',
            'TM_PRECIO',
            'TM_CANTIDAD',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
