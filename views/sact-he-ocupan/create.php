<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SactHeOcupan */

$this->title = 'Create Sact He Ocupan';
$this->params['breadcrumbs'][] = ['label' => 'Sact He Ocupans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sact-he-ocupan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
