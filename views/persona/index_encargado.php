<?php

use yii\helpers\Html;
use yii\helpers\Url;

use kartik\grid\GridView;
use yii\bootstrap\Modal;

use app\models\ManodeobraTrabajan;
use app\models\Actividades;
use app\models\ContratoObrero;
use app\models\UsuariosControla;
use app\models\Usuario;
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

    <h1>Encargado de Obras</h1>
    <p>
        <?= Html::button('Registrar Encargado', ['value'=>Url::to('index.php?r=persona/create-encargado'),'class'=> 'btn btn-success btn-flat','id'=>'modalButton']) ?>
    </p>


<?php 
        Modal::begin([
                'header'=>'<h4>Encargado</h4>',
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
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'PE_RUT',
            //'cA.CA_NOMBRECARGO',
            //'PE_NOMBRES',
            //'PE_APELLIDOPAT',
            [
                'label'=>'Nombre',
                'attribute'=>'PE_NOMBRES',
                'format'=>'raw',
                'value' => function($data){
                    return $data->PE_NOMBRES.' '.$data->PE_APELLIDOPAT.' '.$data->PE_APELLIDOMAT;
                }
            ],
            //'PE_APELLIDOMAT',
            'PE_TELEFONO',

            [
                'label'=>'Proyecto',
                'format'=>'raw',
                'value' => function($data){
                    $usuario = Usuario::find()->where(['PE_RUT'=>$data->PE_RUT])->one();
                    if ($usuario!=NULL) {
                        $controla = UsuariosControla::find()->where(['US_ID'=>$usuario->US_ID])->orderBy(['USCON_ID'=>SORT_DESC])->one();
                        if ($controla!=NULL) {
                            return $controla->pRO->PRO_NOMBRE;
                        }else{
                            return '<span class="not-set">No asignado</span>';
                        }
                    }else{
                        return '<span class="not-set">Sin cuenta</span>';
                    }
                }
            ],


            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{prestamo} {pedido} {proyecto}',
                'buttons' => [
                    'prestamo' => function ($url,$model) {
                        return Html::button(
                            'Ver Proyecto' ,['value'=>Url::to('index.php?r=persona/create-encargado'), 'class'=>'modalUpdate btn btn-flat btn-primary btn-sm', 'idact'=>$model->PE_RUT, 'title'=>'Actualizar']);
                    },
                    'delete' => function ($url,$model) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-remove"></span>',
                            ['delete', 'id'=>$model->PE_RUT],['class'=>'text-red', 'title'=>'Eliminar', 
                                    'data' => [
                                    'confirm' => '¿Esta seguro de borrar esta Actividad?',
                                    'method' => 'post',
                                ],
                            ]);
                    },
                ],
            ],
        ],
    ]); ?>

</div>
</div>

<?php 
$script = <<< JS

    $(document).on('click','.modalUpdate',function(){
        var id = $(this).attr('idact');
        $.get('index.php?r=persona/update-encargado',{'id':id},function(data){
             $('#modal').modal('show')
             .find('.modalContent')
             .html(data);
        });

    });


    $(document).on('click','.modalView',function(){
        var id = $(this).attr('idact');
        $.get('index.php?r=actividades/view',{'id':id},function(data){
             $('#modalUp').modal('show')
             .find('.modalContentUpdate')
             .html(data);
        });
    });
JS;
$this->registerJs($script);
?>
