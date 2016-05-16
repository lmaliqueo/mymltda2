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

$this->title = 'Materiales';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="materiales-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
   </p>
<?php 
    Modal::begin([
            'header'=>'<h4>Material</h4>',
            'id'=>'modal',
            'size'=>'modal-lg',
        ]);
    echo "<div class='modalContent'></div>";
    Modal::end();
 ?>


<br>

<div class="row">
    <div class="col-md-3">
        <?= Html::button('<span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Ingresar Material', ['value'=>Url::to('index.php?r=materiales/create'),'class'=> 'btn btn-success btn-block margin-bottom','id'=>'modalButton']) ?>
        <div class="box box-solid">
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href="#">Materiales</a></li>
                    <li><?= Html::a('Historial Transacciones', ['mat-prov-adquirido/index']) ?></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-9">    
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
                            $almacenados= BoMatAlmacena::find()->where(['MA_ID'=>$model->MA_ID])->all();
                            $stock= StockMateriales::find()->where(['MA_ID'=>$model->MA_ID])->all();
                            return Yii::$app->controller->renderPartial('expandmat', [
                                    'almacenados' => $almacenados,
                                    'stock' => $stock,
                                    'model' => $model,
                                ]);
                        },
                    ],

                    //'MA_ID',
                    'MA_NOMBRE',
                    'MA_CANTIDADTOTAL',
                    'MA_UNIDAD',
                    'MA_MEDIDA',
                    // 'MA_TIPOMATERIALES',
                    // 'MA_COSTOUNIDAD',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>
</div>