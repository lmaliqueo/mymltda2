<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use app\models\BoMatAlmacena;
use app\models\StockMateriales;
use yii\widgets\ActiveForm;

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

<div class="row">
    <div class="col-md-3">
        <?= Html::button('Ingresar Material', ['value'=>Url::to(['create']),'class'=> 'btn btn-success btn-flat btn-block margin-bottom','id'=>'modalButton']) ?>
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Operaciones</h3>
            </div>
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href="#"><i class="fa fa-angle-right"></i> Lista materiales</a></li>
                    <li><?= Html::a('<i class="fa fa-angle-right"></i> Adquisición materiales', ['materiales/orden-compra-index']) ?></li>
                    <li><?= Html::a('<i class="fa fa-angle-right"></i> Despacho materiales', ['materiales/orden-despacho-index']) ?></li>
                    <li><?= Html::a('<i class="fa fa-angle-right"></i> Pedidos materiales', ['materiales/index-pedidos']) ?></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-header">
                <h4 class="box-title">
                    Lista Materiales
                </h4>
                <span class="box-tools pull-right">
                    <div class="has-feedback">
                        <?php 
                        $model=$searchModel;
                        $form = ActiveForm::begin([
                            'action' => ['index'],
                            'method' => 'get',
                        ]); ?>

                        <?= $form->field($model, 'MA_ID')
                                    ->textInput(['class' => 'form-control input-sm',
                                                'placeholder'=>'Buscar Material',
                                                ])
                                    ->label(false) ?>

                        <?php ActiveForm::end(); ?>

                    </div>
                </span>
            </div>
            <div class="box-body">
                <div class="box box-solid collapsed-box">
                    <div class="box-header with-border">
                        <h5 class="no-margin text-blue" style="height: 15px;"><span class="glyphicon glyphicon-search"></span> Busqueda Avanzada</h5>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body" style="display: none;">
                        <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
                    </div>
                </div>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'summary'=>'',
                    //'filterModel' => $searchModel,
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

                        'MA_ID',
                [
                    'label'=>'Descripción',
                    'attribute'=>'MA_NOMBRE',
                    'format'=>'raw',
                    'value' => function($data){
                        return Html::a($data->MA_NOMBRE, '#', ['class'=>'modalView text-muted', 'value'=>Url::to(['materiales/view','id'=>$data->MA_ID])]);
                    }
                ],

                        //'MA_NOMBRE',
                        [
                            'attribute'=>'TMA_ID',
                            'value'=>'tMA.TMA_NOMBRE',
                        ],
                        //'MA_CANTIDADTOTAL',
                        'MA_UNIDAD',
                        //'MA_MEDIDA',
                        'MA_COSTOUNIDAD',

                        //['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
            </div>   
        </div>
    </div>
</div>
</div>