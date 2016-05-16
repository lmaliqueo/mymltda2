<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SpreHeSolicita */

$this->title = 'Create Spre He Solicita';
$this->params['breadcrumbs'][] = ['label' => 'Spre He Solicitas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="spre-he-solicita-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
