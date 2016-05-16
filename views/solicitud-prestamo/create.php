<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SolicitudPrestamo */

$this->title = 'Create Solicitud Prestamo';
$this->params['breadcrumbs'][] = ['label' => 'Solicitud Prestamos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="solicitud-prestamo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'prestamo' => $prestamo,
    ]) ?>

</div>
