<?php

use yii\helpers\Html;
use yii\helpers\Url;

use kartik\grid\GridView;
use yii\bootstrap\Modal;

use app\models\ManodeobraTrabajan;
use app\models\Actividades;
use app\models\ContratoObrero;
use app\models\SueldoObrero;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
if($cargo==4){
$this->title = 'Mano de obra';
}else{
$this->title = 'Personas';

}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="persona-index">

  <?php /*    <h1><?= Html::encode($this->title) ?></h1>
  echo $this->render('_search', ['model' => $searchModel]);*/ ?>

                <?= Html::button('<span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Registrar Persona', ['value'=>Url::to('index.php?r=persona/create'),'class'=> 'btn btn-success btn-flat margin-bottom','id'=>'modalButton']) ?>

<?php 
    Modal::begin([
            'header'=>'<h4>Persona</h4>',
            'id'=>'modal',
            'size'=>'modal-lg',
        ]);
    echo "<div class='modalContent'></div>";
    Modal::end();
 ?>


<div class="box box-primary">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary'=>'',
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'PE_RUT',
            'cA.CA_NOMBRECARGO',
            'PE_NOMBRES',
            'PE_APELLIDOPAT',
            'PE_APELLIDOMAT',
            'PE_TELEFONO',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
</div>
