<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AsignaTiene */

$this->title = 'Create Asigna Tiene';
$this->params['breadcrumbs'][] = ['label' => 'Asigna Tienes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asigna-tiene-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
