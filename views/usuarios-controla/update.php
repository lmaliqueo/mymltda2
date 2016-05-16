<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UsuariosControla */

$this->title = 'Update Usuarios Controla: ' . ' ' . $model->USCON_ID;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios Controlas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->USCON_ID, 'url' => ['view', 'id' => $model->USCON_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="usuarios-controla-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
