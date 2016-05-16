<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BoMatAlmacena */

$this->title = 'Create Bo Mat Almacena';
$this->params['breadcrumbs'][] = ['label' => 'Bo Mat Almacenas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bo-mat-almacena-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
