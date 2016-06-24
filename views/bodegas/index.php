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

<div class="box box-primary">
    <div class="box-body no-padding">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'summary'=>'',
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'BO_ID',
                //'BO_NOMBRE',
                [
                    //'label'=>'N',
                    'attribute'=>'BO_NOMBRE',
                    'format'=>'raw',
                    'value' => function($data){
                        return Html::a($data->BO_NOMBRE, ['materiales/index','id'=>$data->BO_ID], ['class'=>'text-muted orden', 'idbo'=>$data->BO_ID]);
                    }
                ],
                'BO_DIRECCION',
                'BO_CANTIDADHERRAMIENTAS',
                'BO_CANTIDADMATERIALES',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>

</div>
