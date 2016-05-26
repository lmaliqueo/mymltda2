<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ActividadesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = $ordentrabajo->OT_NOMBRE;

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


<h1>Crear Actividades</h1>
<br>
  
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

<div class="row">
<div class="col-md-3">
                <?= Html::button('<span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Crear Actividad', ['value'=>$ordentrabajo->OT_ID,'class'=> 'btn btn-primary btn-block margin-bottom btn-flat', 'id'=>'modalAct']) ?>

    <div class="box box-solid">
        <div class="box-header with-border">
            <h4 class="box-title">Actividades</h4>
        </div>
        <div class="box-body no-padding">
            <ul class="nav nav-pills nav-stacked">
                <?php foreach ($actividades as $actividad) { 
                    $color=NULL;
                    $fecha=date('Y-m-d');
                    if ($actividad->AC_ESTADO == 'En proceso') {
                        $color= 'bg-blue';
                        if ($actividad->AC_FECHA_TERMINO<$fecha) {
                            $color= 'bg-yellow';
                        }
                    }elseif($actividad->AC_ESTADO == 'Finalizado'){
                        $color= 'bg-green';
                    }
                    ?>
                    <li><a href="#"><h3 class="badge <?php echo $color; ?> no-margin"><?= $actividad->AC_NOMBRE ?></h3></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>

</div>
<div class="col-md-9">
        <div class="box box-primary">
            <div class="box-body no-padding">
                <?= \yii2fullcalendar\yii2fullcalendar::widget(array(
                  'events'=> $events,
                  'options'=>[
                    'lang'=>'es',
                  ]
                ));

                ?>
            </div>
        </div>
</div>
</div>





<?php 
$script = <<< JS

    $(document).on('click','.fc-content',function(){
        var act = $(this).text();

        var orden = $('#modalAct').attr('value');

        for (i = 1, len = act.length, text = ""; i < len; i++) { 
            text += act[i];
        }

        $.get('index.php?r=actividades/view-modal',{'act':text , 'ot':orden},function(data){
             $('#modalview').modal('show')
             .find('#modalContent')
             .html(data);
        });

    });


    $(document).on('click','#modalAct',function(){
        var ot=$(this).val();
        $.get('index.php?r=actividades/create',{'id':ot},function(data){
             $('#modalview').modal('show')
             .find('#modalContent')
             .html(data);
        });
    });



JS;
$this->registerJs($script);
?>
