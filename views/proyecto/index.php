<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProyectoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proyecto-index">

    <h1>Proyectos</h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Proyecto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<div class="box box-primary">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
    'summary'=>'',
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'PRO_NOMBRE',
            'PRO_ESTADO',
            'cOM.COM_NOMBRE',
             'PRO_FECHA_INICIO',
             'PRO_DIRECCION',
             //'PRO_OBSERVACIONES:ntext',
            // 'PRO_DESCRIPCION',
             //'PRO_COSTO_TOTAL',
            // 'PRO_INFORME',

            ['class' => 'yii\grid\ActionColumn',
                            'template' => '{OT} {view} {update} {delete}',
                'buttons' => [
                'OT' => function ($url, $model, $key) { // <--- here you can override or create template for a button of a given name
                     return Html::a('<span class="glyphicon glyphicon glyphicon-list" aria-hidden="true"></span>', ['orden-trabajo/indexpro', 'id' => $model->PRO_ID]);
                }
                ],
            ],

        ],
        ]);         Html::a('Create Proyecto', ['create'], ['class' => 'btn btn-success'])
    ?>

</div>
</div>
