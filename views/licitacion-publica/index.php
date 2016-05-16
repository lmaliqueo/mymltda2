<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LicitacionPublicaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Licitacion Publicas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="licitacion-publica-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Licitacion Publica', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'LI_ID',
            'LI_ORGANIZACIONRESPONSABLE',
            'LI_NOMBRELICITACION',
            'LI_DESCRIPCION',
            'LI_DETALLESLICITACION:ntext',
            // 'LI_FECHAPOSTULACION',
            // 'LI_ESTADO',
            // 'LI_CIUDAD',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
