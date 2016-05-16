<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */

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
  
<?php /*
    <h1>Calendario de Actividades</h1>
    <br>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



<div class="row">
    <div class="col-md-3">
            <?= Html::button('<span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Crear Actividad', ['value'=>Url::to(['actividades/crear','ot'=>$ordentrabajo->OT_ID]),'class'=> 'btn btn-success btn-block margin-bottom','id'=>'modalButton']) ?>
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


                <?= \yii2fullcalendar\yii2fullcalendar::widget(array(
                  'events'=> $events,
                  'options'=>[
                    'lang'=>'es',
                  ]
                ));

                ?>

