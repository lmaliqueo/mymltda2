<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TransaccionMateriales */

$this->title = 'Create Transaccion Materiales';
$this->params['breadcrumbs'][] = ['label' => 'Transaccion Materiales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaccion-materiales-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
