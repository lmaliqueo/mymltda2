<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PedidoMaterialesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pedidos de Materiales';
$this->params['breadcrumbs'][] = [
                    'label' => 'Materiales',
                    'url' => ['materiales/index'],
                    //'style'=> 'color:333D43',
                    //'template' => "<li>{link}</li>\n"
                ];
$this->params['breadcrumbs'][] = 'Pedidos Materiales';
?>
<div class="pedido-materiales-index">

    <h1>Pedidos de Materiales</h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
    </p>
<br>

<div class="row">
    <div class="col-md-3">
        <?= Html::a('Crear Pedido de Materiales', ['pedidos/create-multi'], ['class' => 'btn btn-success btn-flat btn-block margin-bottom']) ?>
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Operaciones</h3>
            </div>
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <li><?= Html::a('<i class="fa fa-angle-right"></i> Lista materiales', ['materiales/index']) ?></li>
                    <li><?= Html::a('<i class="fa fa-angle-right"></i> Adquisición materiales', ['materiales/orden-compra-index']) ?></li>
                    <li><?= Html::a('<i class="fa fa-angle-right"></i> Despacho materiales', ['materiales/orden-despacho-index']) ?></li>
                    <li class="active"><a href="#"><i class="fa fa-angle-right"></i> Pedidos Materiales</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-9">    
        <div class="box box-primary">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'summary'=>'',
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'PM_ID',
                    'PRO_ID',
                    'PM_ESTADO',
                    'PM_TITULO',
                    'PM_FECHA',
                    // 'PM_TEXTO:ntext',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>


</div>
