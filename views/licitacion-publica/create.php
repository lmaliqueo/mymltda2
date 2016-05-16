<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LicitacionPublica */

$this->title = 'Create Licitacion Publica';
$this->params['breadcrumbs'][] = ['label' => 'Licitacion Publicas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="licitacion-publica-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
