<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Registrar Usuario', ['create'], ['class' => 'btn btn-flat btn-success']) ?>
    </p>
<div class="box box-primary">
    <div class="box-body">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
        'summary'=>'',
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'US_ID',
                'PE_RUT',
                'US_USERNAME',
                'US_PASSWORD',
                'US_EMAIL:email',
                // 'US_TIPO',
                // 'US_DESCRIPCION',

                ['class' => 'yii\grid\ActionColumn',
                    'template'=>'{view} {update} {delete}',
                    /*'buttons' => [
                        'asignar' => function ($url,$model) {
                            return Html::a('<i class="fa fa-pencil"></i> Asignar rol', ['activar-rol', 'id'=>$model->US_ID],['class'=>'btn btn-default text-blue btn-flat btn-sm']);
                        },
                    ],*/
                ],
            ],
        ]); ?>
    </div>
</div>

</div>
