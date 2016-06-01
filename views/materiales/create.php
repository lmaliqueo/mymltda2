<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Materiales */

$this->title = 'Ingresar Material';
$this->params['breadcrumbs'][] = ['label' => 'Materiales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="materiales-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
