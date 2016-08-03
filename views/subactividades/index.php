<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SubactividadesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Subactividades';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subactividades-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<br>
    <p>
        <?= Html::a('Crear Subactividad', ['crear'], ['class' => 'btn btn-success btn-flat']) ?>
    </p>

    <div class="box box-primary">
        <div class="box-body no-padding">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'summary'=>'',
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'SACT_ID',
                    'SACT_NOMBRE',
                    'SACT_DESCRIPCION:ntext',
                    // 'SACT_COSTO',
                    // 'SACT_CANTIDAD',
                    // 'SACT_CANTIDADMANODEOBRA',

                    ['class' => 'yii\grid\ActionColumn',
                        'template' => '{ver} {recursos} {actualizar}',
                        'buttons' => [
                            'ver' => function ($url, $model, $key) { // <--- here you can override or create template for a button of a given name
                                 return Html::a('Ver', ['asignar', 'id' => $model->SACT_ID], ['class'=>'btn btn-flat btn-default btn-sm text-blue']);
                            },
                            'recursos' => function ($url, $model, $key) { // <--- here you can override or create template for a button of a given name
                                 return Html::a('Asignar Recursos', ['asignar', 'id' => $model->SACT_ID], ['class'=>'btn btn-flat btn-default btn-sm text-blue']);
                            },
                            'actualizar' => function ($url, $model, $key) { // <--- here you can override or create template for a button of a given name
                                 return Html::a('Actualizar', ['asignar', 'id' => $model->SACT_ID], ['class'=>'btn btn-flat btn-default btn-sm text-blue']);
                            },
                        ],
                    ],
                ],
            ]); ?>

        </div>
    </div>

</div>
