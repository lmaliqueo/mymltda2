<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ActividadesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $ordentrabajo->OT_NOMBRE;
$this->params['breadcrumbs'][] = ['label' => $ordentrabajo->pRO->PRO_NOMBRE, 'url' => ['proyecto/view', 'id'=>$ordentrabajo->PRO_ID]];
$this->params['breadcrumbs'][] = ['label' => $ordentrabajo->OT_NOMBRE, 'url' => ['orden-trabajo/indexpro', 'id'=>$ordentrabajo->PRO_ID]];
$this->params['breadcrumbs'][] = 'Calendario de Actividades';
?>
<?php 
    Modal::begin([
            'header'=>'<h4>Crear Actividad</h4>',
            'id'=>'modalActividad',
            'size'=>'modal-lg',
        ]);
    echo "<div class='modalContent'></div>";
    Modal::end();
 ?>

 <?php 
    Modal::begin([
        'header'=>'<h4>Actividad</h4>',
        'id'=>'modalview', 
        'size'=>'modal-lg'  
        ]);
    echo "<div id='modalContent'></div>";

    Modal::end();
  ?>
<div class="actividades-index">
  
<?php /*
    <h1>Calendario de Actividades</h1>
    <br>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



<div class="row">
    <div class="col-md-3">
        <div class="box box-solid">
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <li><?= Html::a('Actividades', ['actividades/index', 'id'=>$ordentrabajo->OT_ID]) ?></li>
                    <li class="active"><a href="#">Calendario de Actividades</a></li>
                     <li><?= Html::a('Reportes de Avances', ['reportes-avances/index', 'id'=>$ordentrabajo->OT_ID]) ?></li>
                    <li><?= Html::a('Movimientos de Materiales', ['orden-trabajo/transaccion', 'id'=>$ordentrabajo->OT_ID]) ?></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-9">


        <div class="box box-primary">
            <div class="box-body no-padding">


            </div>


        </div>

    </div>
</div>*/ ?>
            <?= Html::button('<span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Crear Actividad', ['value'=>Url::to(['actividades/crear','ot'=>$ordentrabajo->OT_ID]),'class'=> 'btn btn-primary','id'=>'modalAct']) ?>
                <?= \yii2fullcalendar\yii2fullcalendar::widget(array(
                  'events'=> $events,
                  'options'=>[
                    'lang'=>'es',
                  ]
                ));

                ?>
</div>

<?php 
$script = <<< JS

    $(document).on('click','.fc-content',function(){
        var act = $(this).text();
        var ot = $('#otid').attr('idot');
        for (i = 1, len = act.length, text = ""; i < len; i++) { 
            text += act[i];
        }

        $.get('index.php?r=actividades/view-modal',{'act':text , 'ot':ot},function(data){
             $('#modalview').modal('show')
             .find('#modalContent')
             .html(data);
        });

    });
   $('#modalAct').click(function() {
     $('#modalActividad').modal('show')
     .find('.modalContent')
     .load($(this).attr('value'));
   });

JS;
$this->registerJs($script);
?>
