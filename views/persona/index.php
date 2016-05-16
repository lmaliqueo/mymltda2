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

        <?php if($cargo==4){ ?>
            <h1>Mano de Obra</h1>
            <p>            
                <?= Html::button('<span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Registrar obrero', ['value'=>Url::to('index.php?r=persona/create-obrero'),'class'=> 'btn btn-success','id'=>'modalButton']) ?>
            </p>
        <?php }elseif($cargo==3){ ?>
            <h1>Encargado de Construcción</h1>
            <p>
                <?= Html::button('<span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Registrar Encargado', ['value'=>Url::to('index.php?r=persona/create'),'class'=> 'btn btn-success','id'=>'modalButton']) ?>
            </p>
        <?php } ?>


<?php 
    if($cargo==4){
        Modal::begin([
                'header'=>'<h4>Obrero</h4>',
                'id'=>'modal',
                'size'=>'modal-lg',
            ]);
        echo "<div class='modalContent'></div>";
        Modal::end();
    }else{
        Modal::begin([
                'header'=>'<h4>Persona</h4>',
                'id'=>'modal',
                'size'=>'modal-lg',
            ]);
        echo "<div class='modalContent'></div>";
        Modal::end();
    }
 ?>


<div class="box box-primary">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
    'summary'=>'',
        'filterModel' => $searchModel,
        'columns' => [
            [                'class' => 'kartik\grid\ExpandRowColumn',
                'value' => function ($model, $key, $index, $column){
                    return GridView::ROW_COLLAPSED;
                },
                'detail' => function ($model, $key, $index, $column){
                    $trabaja= ManodeobraTrabajan::find()->where(['PE_RUT'=>$model->PE_RUT])->asArray()->all();
                    $actividades= Actividades::find()->where(['AC_ID'=>$trabaja, 'AC_ESTADO'=>'En Proceso'])->all();
                    $contrato= ContratoObrero::find()->where(['PE_RUT'=>$model->PE_RUT])->orderBy(['COO_ID' => SORT_DESC,])->one();
                    if($contrato!=NULL){
                        $sueldo= SueldoObrero::find()->where(['COO_ID'=>$contrato->COO_ID])->orderBy(['COO_ID' => SORT_DESC,])->one();
                        return Yii::$app->controller->renderPartial('expandobrero', [
                                'actividades' => $actividades,
                                'model' => $model,
                                'contrato' => $contrato,
                                'sueldo' => $sueldo,
                            ]);
                    }else{
                        return Yii::$app->controller->renderPartial('expandobrero', [
                                'actividades' => $actividades,
                                'model' => $model,
                                'contrato' => $contrato,
                             ]);
                   }
                },
            ],

            'PE_RUT',
            'cA.CA_NOMBRECARGO',
            'PE_NOMBRES',
            'PE_APELLIDOPAT',
            'PE_APELLIDOMAT',
            // 'PE_TELEFONO',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
</div>
