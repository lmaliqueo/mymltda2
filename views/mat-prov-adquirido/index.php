<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MatProvAdquiridoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mat Prov Adquiridos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mat-prov-adquirido-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
        <?= Html::button('<span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Ingresar Transacción', ['value'=>Url::to(['mat-prov-adquirido/transaccion']),'class'=> 'btn btn-success btn-block margin-bottom','id'=>'modalButton']) ?>
        <div class="box box-solid">
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <li><?= Html::a('Materiales', ['materiales/index']) ?></li>
                    <li class="active"><a href="#">Historial Transacciones</a></li>
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
                    ['class' => 'yii\grid\SerialColumn'],

                    'pROV.PROV_NOMBRE',
                    'mA.MA_NOMBRE',
                    'tM.TM_FECHACOMPRA',
                    'tM.TM_CANTIDAD',
                    'tM.TM_PRECIO',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>
</div>
