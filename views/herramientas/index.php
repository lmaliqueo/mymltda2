<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\HerramientaTiene;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

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
            <?= Html::button('Ingresar Herramienta', ['value'=>Url::to(['herramientas/create']),'class'=> 'btn btn-success btn-block btn-flat margin-bottom','id'=>'modalButton']) ?>
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Operaciones</h3>
            </div>
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href="#"><i class="fa fa-angle-right"></i> Lista herramientas</a></li>
                    <li><?= Html::a('<i class="fa fa-angle-right"></i> Despacho de herramientas', ['herramientas/despachos-index']) ?></li>
                    <li><?= Html::a('<i class="fa fa-angle-right"></i> Devolución de herramientas', ['herramientas/retorno-index']) ?></li>
                    <li><?= Html::a('<i class="fa fa-angle-right"></i> Solicitud de Prestamo', ['solicitud-prestamo/index']) ?></li>
                </ul>
            </div>
        </div>
    </div>




    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h4 class="box-title">
                    Lista herramientas
                </h4>
                <div class="box-tools pull-right">
                    <div class="has-feedback">
                        <?php 
                        $model=$searchModel;
                        $form = ActiveForm::begin([
                            'action' => ['index'],
                            'method' => 'get',
                        ]); ?>

                        <?= $form->field($model, 'HE_ID')
                                    ->textInput(['class' => 'form-control input-sm',
                                                'placeholder'=>'Buscar Herramienta',
                                                ])
                                    ->label(false) ?>

                        <?php ActiveForm::end(); ?>
                        
                        <?php /*<input type="text" class="form-control input-sm" placeholder="Buscar herramienta">
                        <span class="fa fa-search form-control-feedback">
                        </span>*/ ?>
                    </div>
                </div>
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
                    //'filterModel' => $searchModel,
                    'summary'=>'',
                    'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                        'HE_ID',
                        'HE_DESCRIPCION',
                        /*
                        [
                            'label'=>'Descripción',
                            'attribute'=>'HE_DESCRIPCION',
                            'format'=>'raw',
                            'value' => function($data){
                                return Html::a($data->HE_DESCRIPCION, '#', ['class'=>'modalView text-muted', 'value'=>Url::to(['herramientas/view','id'=>$data->HE_ID])]);
                            }
                        ],*/
                        [
                            'attribute'=>'TH_ID',
                            'value'=>'tH.TH_NOMBRE',
                        ],
                        
                        [
                            'label'=>'Ubicación',
                            'attribute'=>'BO_ID',
                            //'value'=>'bO.BO_NOMBRE',
                            'value' => function($data){
                                if ($data->HE_ESTADO == 'Libre') {
                                    return $data->bO->BO_NOMBRE;
                                }elseif($data->HE_ESTADO == 'Utilizando'){
                                    return 'Construcción';                                        
                                }
                            }
                        ],
                        //'HE_ESTADO',
                            [
                                'attribute'=>'HE_ESTADO',
                                'format'=>'raw',
                                'value' => function($data){
                                    if ($data->HE_ESTADO == 'Libre') {
                                        return '<span class="label label-success">'.$data->HE_ESTADO.'</span>';
                                    }elseif($data->HE_ESTADO == 'Utilizando'){
                                        return '<span class="label label-warning">'.$data->HE_ESTADO.'</span>';                                        
                                    }
                                }
                            ],
                        //'HE_COSTOUNIDAD',

                        ['class' => 'yii\grid\ActionColumn',
                            'template'=>'{ver} {actualizar}',
                            'buttons'=>[
                                    'ver'=> function ($url,$model) {
                                        return Html::button(
                                            '<i class="fa fa-eye"></i> Ver', [
                                                'value'=>Url::to(['view','id'=>$model->HE_ID]),
                                                'class'=>'btn btn-sm btn-flat btn-default text-blue modalView',
                                                'title'=>'Actualizar'
                                        ]);
                                    },
                                    'actualizar'=> function ($url,$model) {
                                        return Html::button(
                                            '<i class="fa fa-pencil"></i> Actualizar', [
                                                'value'=>Url::to(['update','id'=>$model->HE_ID]),
                                                'class'=>'btn btn-sm btn-flat btn-default text-blue modalAct',
                                                'title'=>'Actualizar'
                                        ]);
                                    },
                            ],
                        ],
                    ],
                ]); ?>

            </div>

        </div>
    </div>
</div>
</div>


<?php 
$script = <<< JS


    $('.modalAct').click(function() {
        $('#modal-view').modal('show')
        .find('.modalContent')
        .load($(this).attr('value'));
    });

JS;
$this->registerJs($script);
?>
