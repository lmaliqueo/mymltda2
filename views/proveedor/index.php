<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProveedorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Proveedores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proveedor-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<br>
    <p>
        <?= Html::a('Ingresar Proveedor', ['create'], ['class' => 'btn btn-success btn-flat']) ?>
    </p>


<div class="box box-primary">
    <div class="box-body no-padding">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'summary'=>'',
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'PROV_ID',
                'PROV_NOMBRE',
                'PROV_CIUDAD',
                'PROV_DIRECCION',
                //'PROV_RAZONSOCIAL',
                // 'PROV_CODIGOPOSTAL',
                // 'PROV_FAX',
                'PROV_EMAIL:email',
                'PROV_CONTACTO',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>

</div>
