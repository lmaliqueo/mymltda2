<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use dosamigos\datepicker\DatePicker;

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


            [
                //'label'=>'N',
                'attribute'=>'PRO_NOMBRE',
                'format'=>'raw',
                'value' => function($data){
                    return Html::a($data->PRO_NOMBRE, ['proyecto/view','id'=>$data->PRO_ID], ['class'=>'text-muted', ]);
                }
            ],

            //'PRO_NOMBRE',
            'PRO_ESTADO',
                        [
                            'attribute'=>'COM_ID',
                            'value'=>'cOM.COM_NOMBRE',
                        ],
             'PRO_FECHA_INICIO:date',
             /*
             [
                'attribute'=>'PRO_FECHA_INICIO',
                'value'=>'PRO_FECHA_INICIO',
                'format'=>'raw',
                'filter'=>DatePicker::widget([
                            'model' => $searchModel,
                            'attribute' => 'PRO_FECHA_INICIO',
                                'clientOptions' => [
                                    'autoclose' => true,
                                    'format' => 'yyyy-mm-dd'
                                ]
                        ])
             ],*/
             'PRO_DIRECCION',
             //'PRO_OBSERVACIONES:ntext',
            // 'PRO_DESCRIPCION',
             //'PRO_COSTO_TOTAL',
            // 'PRO_INFORME',

            //['class' => 'yii\grid\ActionColumn'],

        ],
        ]);         Html::a('Create Proyecto', ['create'], ['class' => 'btn btn-success'])
    ?>

</div>
</div>
