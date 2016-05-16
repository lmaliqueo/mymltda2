<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProveedorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Proveedors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proveedor-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Proveedor', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'PROV_ID',
            'PROV_NOMBRE',
            'PROV_CIUDAD',
            'PROV_CALLE',
            'PROV_RAZONSOCIAL',
            // 'PROV_MUNICIPIO',
            // 'PROV_CODIGOPOSTAL',
            // 'PROV_FAX',
            // 'PROV_EMAIL:email',
            // 'PROV_CONTACTO',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
