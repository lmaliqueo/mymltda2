<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TransaccionMaterialesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="transaccion-materiales-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Transaccion Materiales', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
    'summary'=>'',
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'TM_ID',
                    [
                        'label'=>'Orden de Trabajo',
                        'attribute'=>'SM_ID',
                        'value'=>'sM.oT.OT_NOMBRE',
                    ],
                    [
                        'label'=>'Material',
                        'attribute'=>'SM_ID',
                        'value'=>'sM.mA.MA_NOMBRE',
                    ],
            'SM_ID',
            'TM_FECHACOMPRA',
            'TM_PRECIO',
            'TM_CANTIDAD',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
