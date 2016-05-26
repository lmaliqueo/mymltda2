<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;


/* @var $this yii\web\View */
/* @var $model app\models\OrdenTrabajo */
?>

 <?php 
    Modal::begin([
        'header'=>'<h4>Actividad</h4>',
        'id'=>'modalActiv', 
        'size'=>'modal-lg'  
        ]);
    echo "<div id='modalContentAct'></div>";

    Modal::end();
  ?>

            <?= Html::button('<span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Crear Actividad', ['value'=>$model->OT_ID,'class'=> 'btn btn-primary btn-block margin-bottom modalAct',]) ?>


<?php 
$script = <<< JS

    $(document).on('click','.modalAct',function(){
        var ot=$(this).val();
        $.get('index.php?r=actividades/create',{'id':ot},function(data){
             $('#modalActiv').modal('show')
             .find('#modalContentAct')
             .html(data);
        });
    });


JS;
$this->registerJs($script);
?>
