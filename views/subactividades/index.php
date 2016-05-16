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

    <p>
        <?= Html::a('Create Subactividades', ['crear'], ['class' => 'btn btn-success']) ?>
    </p>

<div class="box box-primary">
    <div class="box-body">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'SACT_ID',
                'SACT_NOMBRE',
                'SACT_DESCRIPCION:ntext',
                'SACT_COSTO',
                // 'SACT_CANTIDAD',
                // 'SACT_CANTIDADMANODEOBRA',

                ['class' => 'yii\grid\ActionColumn',
                    'template' => '{recursos} {view} {update} {delete}',
                    'buttons' => [
                        'recursos' => function ($url, $model, $key) { // <--- here you can override or create template for a button of a given name
                             return Html::a('<span class="glyphicon glyphicon glyphicon-list-alt" aria-hidden="true"></span>', ['asignar', 'id' => $model->SACT_ID]);
                        },
                    ],
                ],
            ],
        ]); ?>

    </div>
</div>

</div>
