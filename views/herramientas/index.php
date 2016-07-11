<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\HerramientaTiene;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\HerramientasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Herramientas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="herramientas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?php 
    Modal::begin([
            'header'=>'<h4>Ingresar Herramienta</h4>',
            'id'=>'modal',
            'size'=>'modal-lg',
        ]);
    echo "<div class='modalContent'></div>";
    Modal::end();
 ?>
<?php 
    Modal::begin([
            'header'=>'<h4>Herramienta</h4>',
            'id'=>'modal-view',
            'size'=>'modal-lg',
        ]);
    echo "<div class='modalContent'></div>";
    Modal::end();
 ?>


<br>
<div class="row">
    <div class="col-md-3">
            <?= Html::button('<span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Ingresar Herramienta', ['value'=>Url::to(['herramientas/create']),'class'=> 'btn btn-success btn-block margin-bottom','id'=>'modalButton']) ?>
        <div class="box box-solid">
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <li><?= Html::a('Materiales', ['materiales/index']) ?></li>
                    <li class="active"><a href="#">Herramientas</a></li>
                    <li><?= Html::a('Solicitud de Prestamo', ['solicitud-prestamo/index']) ?></li>
                </ul>
            </div>
        </div>
    </div>




    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-body no-padding">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'summary'=>'',
                    //'summary' => "asd {begin} - {end} of {totalCount} items",
                    'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
        /*
                        [                'class' => 'kartik\grid\ExpandRowColumn',
                            'value' => function ($model, $key, $index, $column){
                                return GridView::ROW_COLLAPSED;
                            },
                            'detail' => function ($model, $key, $index, $column){
                                $hetiene= HerramientaTiene::find()->where(['HE_ID'=>$model->HE_ID])->all();

                                return Yii::$app->controller->renderPartial('expandhe', [
                                        'hetiene' => $hetiene,
                                        'model' => $model,
                                    ]);
                            },
                        ],*/
                        //'HE_NOMBRE',
            [
                'label'=>'Descripción',
                'attribute'=>'HE_NOMBRE',
                'format'=>'raw',
                'value' => function($data){
                    return Html::a($data->HE_NOMBRE, '#', ['class'=>'modalView text-muted', 'value'=>Url::to(['herramientas/view','id'=>$data->HE_ID])]);
                }
            ],
                        [
                            'attribute'=>'TH_ID',
                            'value'=>'tH.TH_NOMBRE',
                        ],
                        
                        [
                            'attribute'=>'BO_ID',
                            'value'=>'bO.BO_NOMBRE',
                        ],
                        'HE_CANT',
                        'HE_COSTOUNIDAD',

                        ['class' => 'yii\grid\ActionColumn',
                            'template'=>NULL,
                        ],
                    ],
                ]); ?>

            </div>

        </div>
    </div>
</div>
</div>