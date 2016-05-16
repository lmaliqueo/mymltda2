<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EmpresaClienteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Empresa Clientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="empresa-cliente-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Empresa Cliente', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'EMP_RUT',
            'COM_ID',
            'EMP_RAZON',
            'EMP_NOMBRE',
            'EMP_RUBRO',
            // 'EMP_DIRECCION',
            // 'EMP_TELEFONO',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
