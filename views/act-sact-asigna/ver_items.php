<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\ActSactAsigna */

$this->title = 'Lista Items';
$this->params['breadcrumbs'][] = ['label' => 'Act Sact Asignas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="act-sact-asigna-view">




<?php 
    Modal::begin([
            'header'=>'<h4>Sub-Actividad</h4>',
            'id'=>'modal',
            'size'=>'modal-lg',
        ]);
    echo "<div class='modalContent'></div>";
    Modal::end();
 ?>



    <h1><?= Html::encode($this->title) ?></h1>
<br>

                <?= Html::a('Volver a Actividades', ['orden-trabajo/index-actividades','id'=>$actividad->OT_ID], ['class'=> 'btn btn-primary btn-flat margin-bottom']) ?>
                <?= Html::button('Asignar Sub-Actividad', ['value'=>Url::to(['act-sact-asigna/create','id'=>$actividad->AC_ID]), 'class'=> 'btn btn-success btn-flat margin-bottom modalForm']) ?>
        <div class="box box-primary">
            <div class="box-header with-border"><h4 class="box-title">Sub-Actividades Asignados</h4>
            <div class="box-tools">
            </div>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <tr class="bg-light-blue">
                        <th>Cantidad</th>
                        <th>Subactividad</th>
                        <th>Costo por Item</th>
                        <th>Progreso</th>
                        <th>Recursos</th>
                        <th></th>
                   </tr>
                <tbody class="">
                    <?php foreach ($items as $key): ?>
                        <tr>
                            <td><?= $key->AS_CANTIDAD ?></td>
                            <td><?= $key->sACT->SACT_NOMBRE ?></td>
                            <td>$ <?= $key->AS_COSTOTOTAL ?></td>
                            <td></td>
                            <td>
                                <?= Html::button('Ver Recursos', ['value'=>Url::to(['act-sact-asigna/asignar-recursos','id'=>$key->AS_ID]), 'class'=> 'btn btn-flat btn-sm btn-default text-blue modalForm']) ?>
                            </td>
                            <td>
                                <?= Html::button( $key->isNullMat($key->AS_ID) ? 'Modificar Materiales Asignados' : 'Asignar Materiales', ['value'=>Url::to(['act-sact-asigna/asignar-recursos','id'=>$key->AS_ID]), 'class'=>  $key->isNullMat($key->AS_ID) ? 'btn btn-flat btn-default text-blue btn-sm modalHe modalForm' : 'btn btn-flat btn-primary btn-sm modalHe modalForm', 'title'=>'Asignar Recursos']) ?>

                                <?= Html::button($key->isNullMat($key->AS_ID) ? 'Modificar Herramientas Asignadas' : 'Asignar Herramientas', ['value'=>Url::to(['act-sact-asigna/asignar-herramientas','id'=>$key->AS_ID]), 'class'=> $key->isNullHe($key->AS_ID) ? 'btn btn-flat btn-default text-blue btn-sm modalHe modalForm' : 'btn btn-flat btn-primary btn-sm modalHe modalForm', 'title'=>'Asignar Herramienta']) ?>

                                <?= Html::a('Eliminar Item', ['delete', 'id' => $key->AS_ID], [
                                    'class' => 'btn btn-flat btn-sm btn-danger',
                                    'data' => [
                                        'confirm' => '¿Esta seguro de borrar este Item?',
                                        'method' => 'post',
                                    ],
                                ]) ?>
                            </td>
                        </tr>
                    <?php endforeach ?>

                </tbody>
               </table>
            </div>
        </div>

</div>
