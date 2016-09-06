<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = 'Ver Perfil';
//$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-view">
<?php 
    Modal::begin([
            'header'=>'<h4>Usuario</h4>',
            'id'=>'modal',
            'size'=>'modal-tn',
        ]);
    echo "<div class='modalContent'></div>";
    Modal::end();
 ?>

<br>
<div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="no-margin"><?= Html::encode($this->title) ?></h1>
            <div class="box-tools">
                <?= Html::button('Cambiar Contraseña', ['value'=>Url::to(['cambiar-password']),'class'=> 'btn btn-flat btn-default bg-light-blue','id'=>'modalButton']) ?>
            </div>
    </div>
    <div class="box-body">
        <br>
        <div class="box box-primary">
            <div class="box-header">
                <h4 class="box-title">
                    Datos del Usuario
                </h4>
            </div>
            <div class="box-body">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        //'US_ID',
                        //'PE_RUT',
                        'US_USERNAME',
                        //'US_PASSWORD',
                        'US_EMAIL:email',
                        'US_TIPO',
                        'US_DESCRIPCION',
                    ],
                ]) ?>
            </div>
        </div>

        <div class="box box-primary">
            <div class="box-header">
                <h4 class="box-title">
                    Datos Personales
                </h4>
            </div>
            <div class="box-body">
                <?= DetailView::widget([
                    'model' => $persona,
                    'attributes' => [
                        'PE_RUT',
                        'PE_NOMBRES',
                        'PE_APELLIDOPAT',
                        'PE_APELLIDOMAT',
                        'cA.CA_NOMBRECARGO',
                        'PE_TELEFONO',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>



    <p>
        <?= Html::a('Update', ['update', 'id' => $model->US_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->US_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>


</div>
