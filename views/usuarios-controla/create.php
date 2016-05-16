<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UsuariosControla */

$this->title = 'Create Usuarios Controla';
$this->params['breadcrumbs'][] = ['label' => 'Usuarios Controlas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-controla-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
