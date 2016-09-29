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



<?php 
    Modal::begin([
            'header'=>'<h4>Obrero</h4>',
            'id'=>'modal-view',
            'size'=>'modal-lg',
        ]);
    echo "<div class='modalContent'></div>";
    Modal::end();
 ?>
<?php 
    Modal::begin([
            'header'=>'<h4>Obrero</h4>',
            'id'=>'modal-view-tn',
            'size'=>'modal-tn',
        ]);
    echo "<div class='modalContent'></div>";
    Modal::end();
 ?>
 <h1>Mano de Obra</h1>

<br>

    <?= Html::button('Registrar obrero',
                         ['value'=>Url::to('index.php?r=persona/create-obrero'),'class'=> 'btn btn-success btn-flat modalView margin-bottom']) ?>

<div class="box box-primary">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
    'summary'=>'',
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            /*[                'class' => 'kartik\grid\ExpandRowColumn',
                'value' => function ($model, $key, $index, $column){
                    return GridView::ROW_COLLAPSED;
                },
                'detail' => function ($model, $key, $index, $column){
                    $trabaja= ManodeobraTrabajan::find()->where(['PE_RUT'=>$model->PE_RUT])->asArray()->all();
                    $actividades= Actividades::find()->where(['AC_ID'=>$trabaja, 'AC_ESTADO'=>'En Proceso'])->all();
                    $contrato= ContratoObrero::find()->where(['PE_RUT'=>$model->PE_RUT])->orderBy(['COO_ID' => SORT_DESC,])->one();
                    if($contrato!=NULL){
                        $sueldo= SueldoObrero::find()->where(['COO_ID'=>$contrato->COO_ID])->orderBy(['SU_ID' => SORT_DESC,])->one();
                    }else{
                        $sueldo= NULL;
                    }
                    return Yii::$app->controller->renderPartial('expandobrero', [
                            'actividades' => $actividades,
                            'model' => $model,
                            'contrato' => $contrato,
                            'sueldo' => $sueldo,
                    ]);
                },
            ],*/

            'PE_RUT',
            [
                'label'=>'Nombre',
                'attribute'=>'PE_NOMBRES',
                'format'=>'raw',
                'value' => function($data){
                    return $data->PE_NOMBRES.' '.$data->PE_APELLIDOPAT.' '.$data->PE_APELLIDOMAT;
                }
            ],
            [
                'header'=>'Tipo Obrero',
                'format'=>'raw',
                'value' => function($data){
                    $contrato = ContratoObrero::find()->where(['PE_RUT'=>$data->PE_RUT])->orderBy(['COO_ID'=>SORT_DESC])->one();
                    if ($contrato!=NULL) {
                        return $contrato->tOB->TOB_NOMBRE;
                    }else{
                        return '<span class="not-set">Sin contrato</span>';
                    }
                }                
            ],
            [
                'header'=>'Proyecto',
                'format'=>'raw',
                'value' => function($data){
                    $contrato = ContratoObrero::find()->where(['PE_RUT'=>$data->PE_RUT])->orderBy(['COO_ID'=>SORT_DESC])->one();
                    if ($contrato!=NULL) {
                        return $contrato->pRO->PRO_NOMBRE;
                    }else{
                        return '<span class="not-set">Sin contrato</span>';
                    }
                }                
            ],
            [
                'header'=>'Sueldo',
                'format'=>'integer',
                'value' => function($data){
                    $contrato = ContratoObrero::find()->where(['PE_RUT'=>$data->PE_RUT])->orderBy(['COO_ID'=>SORT_DESC])->one();
                    if ($contrato!=NULL) {
                        $sueldo = SueldoObrero::find()->where(['COO_ID'=>$contrato->COO_ID])->orderBy(['SU_ID'=>SORT_DESC])->one();
                        if ($sueldo!=NULL) {
                            return $sueldo->SU_CANTIDAD;
                        }else{
                            return '<span class="not-set">Sin Sueldo<span>';
                        }
                    }else{
                        return '<span class="not-set">Sin Contrato<span>';
                    }
                }
            ],
            //'cA.CA_NOMBRECARGO',
            //'PE_NOMBRES',
            //'PE_APELLIDOPAT',
            //'PE_APELLIDOMAT',
            //'PE_TELEFONO',

            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{contrato} {trabajos} {asignar}',
                'buttons' => [
                    'contrato' => function ($url,$model) {
                        $contrato = ContratoObrero::find()->where(['PE_RUT'=>$model->PE_RUT])->one();
                        if($contrato!=NULL){
                            return Html::button('<i class="fa fa-eye"></i> Ver Contrato', ['value'=>Url::to(['persona/ver-contrato-ob', 'rut'=>$model->PE_RUT]),'class'=> 'btn btn-default btn-flat btn-sm modalViewTn text-blue',]);
                        }else{
                            return Html::button('Ingresar Contrato', ['value'=>Url::to(['persona/crear-contrato-ob', 'rut'=>$model->PE_RUT]),'class'=> 'btn btn-success btn-flat btn-sm modalViewTn',]);
                        }
                    },
                    'trabajos' => function ($url,$model) {
                        $contrato = ContratoObrero::find()->where(['PE_RUT'=>$model->PE_RUT])->one();
                        if($contrato!=NULL){
                            return Html::button('<i class="fa fa-calendar"></i> Ver Actividades', ['value'=>Url::to(['ver-proyecto', 'rut'=>$model->PE_RUT]),'class'=> 'btn btn-default btn-flat btn-sm modalViewTn text-blue',]);
                        }
                    },
                    'asignar' => function ($url,$model) {
                        $contrato = ContratoObrero::find()->where(['PE_RUT'=>$model->PE_RUT])->one();
                        if($contrato!=NULL && $contrato->COO_ESTADO == 'Activo'){
                            return Html::button('<i class="fa fa-pencil"></i> Asignar Actividades', ['value'=>Url::to(['ver-proyecto', 'rut'=>$model->PE_RUT]),'class'=> 'btn btn-default btn-flat btn-sm modalViewTn text-blue',]);
                        }
                    },
                ],
            ],
        ],
    ]); ?>
      
</div>
</div>

