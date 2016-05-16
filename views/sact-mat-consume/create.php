<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SactMatConsume */

$this->title = 'Create Sact Mat Consume';
$this->params['breadcrumbs'][] = ['label' => 'Sact Mat Consumes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sact-mat-consume-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
