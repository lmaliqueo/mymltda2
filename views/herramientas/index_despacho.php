<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\HerramientaTiene;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\HerramientasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Despacho Herramientas';
$this->params['breadcrumbs'][] = [
                    'label' => 'Herramientas',
                    'url' => ['herramientas/index'],
                    //'style'=> 'color:333D43',
                    //'template' => "<li>{link}</li>\n"
                ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="herramientas-index">

    <h1>Despacho de herramientas</h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?php 
    Modal::begin([
            'header'=>'<h4>Ingresar Herramienta</h4>',
            'id'=>'modal',
            'size'=>'modal-lg',
        ]);
    echo "<div class='modalContent'></div>";
    Modal::end();
 ?>
<?php 
    Modal::begin([
            'header'=>'<h4>Herramienta</h4>',
            'id'=>'modal-view',
            'size'=>'modal-lg',
        ]);
    echo "<div class='modalContent'></div>";
    Modal::end();
 ?>


<br>
<div class="row">
    <div class="col-md-3">
            <?= Html::a('Ingresar Despacho', ['herramientas/crear-despachos'], ['class'=> 'btn btn-primary btn-block btn-flat margin-bottom']) ?>
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Operaciones</h3>
            </div>
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <li><?= Html::a('<i class="fa fa-angle-right"></i> Lista herramientas', ['herramientas/index']) ?></li>
                    <li class="active"><a href="#"><i class="fa fa-angle-right"></i> Despacho de herramientas</a></li>
                    <li><?= Html::a('<i class="fa fa-angle-right"></i> Devolución de herramientas', ['herramientas/retorno-index']) ?></li>
                    <li><?= Html::a('<i class="fa fa-angle-right"></i> Solicitud de Prestamo', ['solicitud-prestamo/index']) ?></li>
                </ul>
            </div>
        </div>
    </div>




    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h4 class="box-title">
                    Despachos
                </h4>
            </div>
            <div class="box-body">

                <table class="table table-bordered">
                    <tr class="bg-light-blue">
                        <th>ID</th>
                        <th>Orden de Trabajo</th>
                        <th>Encargado Responsable</th>
                        <th>Fecha Despacho</th>
                        <th>Estado</th>
                        <th></th>
                    </tr>
                    <?php foreach ($despachos_he as $despacho) { ?>
                        <tr>
                            <td><?= $despacho->DH_ID ?></td>
                            <td><?= $despacho->oT->OT_NOMBRE ?></td>
                            <td></td>
                            <td><?= $despacho->DH_FECHA_SALIDA ?></td>
                            <td><?= $despacho->DH_ESTADO ?></td>

                        </tr>
                    <?php } ?>

                </table>



            </div>

        </div>
    </div>
</div>
</div>


<?php 
$script = <<< JS


    $('.modalAct').click(function() {
        $('#modal-view').modal('show')
        .find('.modalContent')
        .load($(this).attr('value'));
    });

JS;
$this->registerJs($script);
?>
