<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\SpreHeSolicita;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SolicitudPrestamoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Solicitud Prestamos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="solicitud-prestamo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Solicitud Prestamo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<div class="box box-primary">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [                'class' => 'kartik\grid\ExpandRowColumn',
                'value' => function ($model, $key, $index, $column){
                    return GridView::ROW_COLLAPSED;
                },
                'detail' => function ($model, $key, $index, $column){
                    $solicita= SpreHeSolicita::find()->where(['SPRE_ID'=>$model->SPRE_ID])->all();

                    return Yii::$app->controller->renderPartial('expandspre', [
                            'solicita' => $solicita,
                            'model' => $model,
                        ]);
                },
            ],

            //'SPRE_ID',
            'PE_RUT',
            'SPRE_TITULO',
            'SPRE_FECHA',
            'SPRE_ESTADO',
            // 'SPRE_TEXTO:ntext',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{aprobar} {view} {update} {delete}',
                'buttons' => [
                'aprobar' => function ($url, $model, $key) { // <--- here you can override or create template for a button of a given name
                     return Html::a('<span class="glyphicon glyphicon glyphicon-ok" aria-hidden="true"></span>', ['solicitud-prestamo/aprobar', 'id' => $model->SPRE_ID]);
                },
            ],
            ],
        ],
    ]); ?>
</div>
</div>
