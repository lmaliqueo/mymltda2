<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use app\models\BoMatAlmacena;
use app\models\StockMateriales;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MaterialesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="materiales-index">

<?php 
    Modal::begin([
            'header'=>'<h4>Nuevo Material</h4>',
            'id'=>'modal',
            'size'=>'modal-lg',
        ]);
    echo "<div class='modalContent'></div>";
    Modal::end();
 ?>

<?php 
    Modal::begin([
            'header'=>'<h4>Material</h4>',
            'id'=>'modal-view',
            'size'=>'modal-lg',
        ]);
    echo "<div class='modalContent'></div>";
    Modal::end();
 ?>

<br>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
        'summary'=>'',
                'filterModel' => $searchModel,
                'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                /*    [                'class' => 'kartik\grid\ExpandRowColumn',
                        'value' => function ($model, $key, $index, $column){
                            return GridView::ROW_COLLAPSED;
                        },
                        'detail' => function ($model, $key, $index, $column){
                            $almacenados= BoMatAlmacena::find()->where(['MA_ID'=>$model->MA_ID])->all();
                            $stock= StockMateriales::find()->where(['MA_ID'=>$model->MA_ID])->all();
                            return Yii::$app->controller->renderPartial('expandmat', [
                                    'almacenados' => $almacenados,
                                    'stock' => $stock,
                                    'model' => $model,
                                ]);
                        },
                    ],*/

                    [
                        'label'=>'Orden de Trabajo',
                        'attribute'=>'OT_ID',
                        'value'=>'oT.OT_NOMBRE',
                    ],
            [
                'label'=>'Material',
                'attribute'=>'MA_ID',
                'format'=>'raw',
                'value' => function($data){
                    return Html::a($data->MA_NOMBRE, '#', ['class'=>'modalView text-muted', 'value'=>Url::to(['materiales/view','id'=>$data->MA_ID])]);
                }
            ],
                    //'MA_ID',
                    //'MA_NOMBRE',
                    [
                        'label'=>'Tipo',
                        'attribute'=>'MA_ID',
                        'value'=>'mA.tMA.TMA_NOMBRE',
                    ],
                    [
                        'label'=>'Unidad',
                        'attribute'=>'MA_ID',
                        'value'=>'mA.MA_UNIDAD',
                    ],
                    'SM_CANTIDAD',
                    /*[
                        'label'=>'Costo',
                        'attribute'=>'MA_ID',
                        'value'=>'mA.MA_COSTOUNIDAD',
                    ],*/
                    //'MA_MEDIDA',
                    //'SM_ESTADO',
                    //['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
</div>