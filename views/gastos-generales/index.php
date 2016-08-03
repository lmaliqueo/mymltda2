<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GastosGeneralesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gastos Generales';
$this->params['breadcrumbs'][] = ['label' => 'Ordenes de Trabajos', 'url' => ['orden-trabajo/index']];
$this->params['breadcrumbs'][] = [
                    'label' => $ordentrabajo->OT_NOMBRE,
                    //'url' => ['orden-trabajo/index'],
                    'style'=> 'color:white',
                    'template' => "<button class='btn btn-flat btn-sm' style='background-color : #333D43; color:white; float:right; margin-left: 4px;'>{link}</button>\n"
                ];
$this->params['breadcrumbs'][] = 'Gastos Generales';
?>
<div class="gastos-generales-index">

    <h1>Gastos Generales</h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<br>


<?php 
    Modal::begin([
            'header'=>'<h4>Gastos Generales</h4>',
            'id'=>'modal',
            'size'=>'modal-lg',
        ]);
    echo "<div class='modalContent'></div>";
    Modal::end();
 ?>


<div class="row">
    <div class="col-md-3">
            <?= Html::button('Crear Gastos Generales', ['value'=>Url::to(['gastos-generales/create','id'=>$ordentrabajo->OT_ID]),'class'=> 'btn btn-primary btn-block btn-flat margin-bottom','id'=>'modalButton']) ?>
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Orden de Trabajo</h3>
            </div>
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <li><?= Html::a('<i class="fa fa-tasks"></i> Actividades', ['orden-trabajo/index-actividades', 'id'=>$ordentrabajo->OT_ID]) ?></li>
                    <li><?= Html::a('<i class="fa fa-file-excel-o"></i> Estados de Pagos', ['orden-trabajo/index-estado-pago', 'id'=>$ordentrabajo->OT_ID]) ?></li>
                    <li><?= Html::a('<i class="fa fa-inbox"></i> Reportes de Avances', ['orden-trabajo/index-reportes-avances', 'id'=>$ordentrabajo->OT_ID]) ?></li>
                    <li class="active"><a href="#"><i class="glyphicon glyphicon-usd"></i> Gastos Generales</a></li>
                    <li><?= Html::a('<i class="glyphicon glyphicon-list-alt"></i> Materiales', ['orden-trabajo/index-materiales', 'id'=>$ordentrabajo->OT_ID]) ?></li>
                    <li><?= Html::a('<i class="fa fa-line-chart"></i> Gráfico', ['orden-trabajo/grafico-ot', 'id'=>$ordentrabajo->OT_ID]) ?></li>
                    <li><?= Html::a('<i class="glyphicon glyphicon-file"></i> Informes', ['proyecto/informes-pro', 'id'=>$ordentrabajo->PRO_ID]) ?></li>
                </ul>
            </div>
        </div>
    </div>




    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-body no-padding">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    //'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'GG_ID',
                        'OT_ID',
                        'GG_TIPO',
                        'GG_DESCRIPCION:ntext',
                        'GG_COSTO',
                        // 'GG_TEXT',

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>

            </div>
        </div>
    </div>
</div>
</div>
