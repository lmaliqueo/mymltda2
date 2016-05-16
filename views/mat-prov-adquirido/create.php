<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MatProvAdquirido */

$this->title = 'Create Mat Prov Adquirido';
$this->params['breadcrumbs'][] = ['label' => 'Mat Prov Adquiridos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mat-prov-adquirido-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'almacena'=>$almacena,
        'transaccion'=>$transaccion,
        'stock'=>$stock,
    ]) ?>

</div>
